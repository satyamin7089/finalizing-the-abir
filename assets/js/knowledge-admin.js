(() => {
  const labels = {
    question: 'Question', answer: 'Answer', material: 'Material / option',
    best_for: 'Typical fit', consideration: 'Key consideration',
    detail: 'When to consider it', label: 'Link label', url: 'Full URL or site path'
  };
  const richKeys = new Set(['answer', 'detail']);

  function fieldValue(field) {
    return field.isContentEditable ? field.innerHTML : field.value;
  }
  function syncRepeater(group) {
    const output = group.querySelector('.ab-repeater-json');
    const rows = [...group.querySelectorAll('[data-row]')].map(row => {
      const item = {};
      row.querySelectorAll('[data-field]').forEach(field => { item[field.dataset.field] = fieldValue(field); });
      return item;
    }).filter(row => Object.values(row).some(value => String(value).trim() !== ''));
    if (output) output.value = JSON.stringify(rows);
  }
  function richTools() {
    const toolbar = document.createElement('div');
    toolbar.className = 'ab-rich-toolbar';
    toolbar.setAttribute('role', 'toolbar');
    toolbar.setAttribute('aria-label', 'Text formatting');
    [
      ['bold', 'B', 'Bold'], ['italic', 'I', 'Italic'],
      ['insertUnorderedList', '• List', 'Bulleted list'], ['link', '↗ Link', 'Insert link']
    ].forEach(([command, text, label]) => {
      const button = document.createElement('button');
      button.type = 'button'; button.className = 'button';
      button.dataset.richCommand = command; button.setAttribute('aria-label', label);
      button.textContent = text; toolbar.append(button);
    });
    return toolbar;
  }
  function makeRichRepeaterField(key, caption, value = '') {
    const wrapper = document.createElement('div');
    wrapper.className = 'ab-repeater-rich';
    const title = document.createElement('span');
    title.className = 'ab-admin-field-title'; title.textContent = caption;
    const editor = document.createElement('div');
    editor.className = 'ab-rich-editable'; editor.contentEditable = 'true';
    editor.dataset.field = key; editor.setAttribute('role', 'textbox'); editor.setAttribute('aria-multiline', 'true');
    editor.innerHTML = value;
    wrapper.append(title, richTools(), editor);
    return wrapper;
  }
  function makeRepeaterRow(fields) {
    const row = document.createElement('div');
    row.className = 'ab-repeater-row'; row.dataset.row = '';
    fields.forEach(key => {
      const caption = labels[key] || key;
      if (richKeys.has(key)) {
        row.append(makeRichRepeaterField(key, caption));
      } else {
        const label = document.createElement('label');
        label.append(document.createTextNode(caption));
        const input = document.createElement('textarea');
        input.dataset.field = key; input.rows = 2;
        label.append(input); row.append(label);
      }
    });
    const remove = document.createElement('button');
    remove.type = 'button'; remove.className = 'button-link-delete';
    remove.dataset.remove = ''; remove.textContent = 'Remove row'; row.append(remove);
    return row;
  }

  document.querySelectorAll('[data-repeater]').forEach(group => {
    let fields = [];
    try { fields = JSON.parse(group.dataset.fields || '[]'); } catch (_) { fields = []; }
    const rows = group.querySelector('[data-rows]');
    group.addEventListener('click', event => {
      if (event.target.closest('[data-add]')) {
        rows.append(makeRepeaterRow(fields)); syncRepeater(group);
      }
      const remove = event.target.closest('[data-remove]');
      if (remove) { remove.closest('[data-row]').remove(); syncRepeater(group); }
    });
    group.addEventListener('input', () => syncRepeater(group));
    syncRepeater(group);
  });

  // Section notes are opt-in: open an editor only when the author chooses to add/edit one.
  document.querySelectorAll('[data-section-note]').forEach(wrapper => {
    const toggle = wrapper.querySelector('[data-section-note-toggle]');
    const editor = wrapper.querySelector('.ab-admin-section-note-editor');
    if (!toggle || !editor) return;

    const setOpen = open => {
      wrapper.classList.toggle('is-enabled', open);
      editor.hidden = !open;
      toggle.setAttribute('aria-expanded', String(open));
      toggle.textContent = open ? 'Hide note editor' : '+ Add optional note / disclaimer';
    };

    setOpen(wrapper.classList.contains('is-enabled'));
    toggle.addEventListener('click', () => {
      setOpen(!wrapper.classList.contains('is-enabled'));
    });
  });

  function syncRichFields() {
    document.querySelectorAll('.ab-admin-rich-field').forEach(wrapper => {
      const editor = wrapper.querySelector('[data-rich-field]');
      const output = wrapper.querySelector('[data-rich-output]');
      if (editor && output) output.value = editor.innerHTML;
    });
  }
  function escapeHtml(value) {
    return String(value).replace(/[&<>"']/g, character => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[character]));
  }
  document.addEventListener('mousedown', event => {
    if (event.target.closest('[data-rich-command]')) event.preventDefault();
  });
  document.addEventListener('click', event => {
    const button = event.target.closest('[data-rich-command]');
    if (!button) return;
    const wrapper = button.closest('.ab-admin-rich-field, .ab-repeater-rich');
    const editor = wrapper && wrapper.querySelector('[contenteditable="true"]');
    if (!editor) return;
    editor.focus();
    const command = button.dataset.richCommand;
    if (command === 'link') {
      const url = window.prompt('Enter the link URL (site path or full URL):');
      if (!url) return;
      const selection = window.getSelection();
      const selectedText = selection && selection.toString();
      if (selectedText && editor.contains(selection.anchorNode)) {
        document.execCommand('createLink', false, url.trim());
      } else {
        const linkText = window.prompt('Text to display for this link:');
        if (linkText) document.execCommand('insertHTML', false, `<a href="${escapeHtml(url.trim())}">${escapeHtml(linkText)}</a>`);
      }
    } else {
      document.execCommand(command, false, null);
    }
    editor.dispatchEvent(new Event('input', { bubbles: true }));
    syncRichFields();
  });
  document.addEventListener('input', event => {
    if (event.target.closest('.ab-admin-rich-field')) syncRichFields();
  });

  document.querySelectorAll('.ab-rich-editable').forEach(editor => {
    editor.addEventListener('input', () => {
      const repeater = editor.closest('[data-repeater]');
      if (repeater) syncRepeater(repeater);
      syncRichFields();
    });
  });
  document.querySelectorAll('.ab-admin-rich-field').forEach(wrapper => {
    const editor = wrapper.querySelector('[data-rich-field]');
    if (editor) editor.addEventListener('input', syncRichFields);
  });
  syncRichFields();
  const postForm = document.getElementById('post');
  if (postForm) postForm.addEventListener('submit', () => {
    document.querySelectorAll('[data-repeater]').forEach(syncRepeater);
    syncRichFields();
  }, true);
})();