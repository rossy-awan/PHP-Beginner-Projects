<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sticky Notes for Science</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
</head>
<body class="bg-[#121212] font-sans text-[#e5e5e5]">
  <div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">🔬 Sticky Notes for Science</h1>
    <form id="noteForm" class="bg-[#1e1e1e] rounded-xl p-5 shadow-sm space-y-4">
      <input name="name" type="text" placeholder="Name" class="w-full bg-[#2a2a2a] rounded-lg p-2 focus:outline-none focus:ring focus:ring-yellow-500 text-[#e5e5e5] placeholder-[#888]" required>
      <textarea name="content" rows="3" placeholder="Write a note (LaTeX with $...$ or $$...$$)" class="w-full bg-[#2a2a2a] rounded-lg p-2 focus:outline-none focus:ring focus:ring-yellow-500 text-[#e5e5e5] placeholder-[#888]" style="min-height:6rem; max-height:16rem;" required></textarea>
      <button class="px-4 py-2 rounded-lg bg-yellow-500 text-black font-semibold hover:bg-yellow-400">Save</button>
    </form>
    <div id="notesGrid" class="mt-8 grid sm:grid-cols-2 gap-4"></div>
  </div>

<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function renderLatex(el) {
  window.renderMathInElement(el, {
    delimiters: [
      {left: '$$', right: '$$', display: true},
      {left: '$', right: '$', display: false}
    ],
    throwOnError: false
  });
}

async function loadNotes() {
  const grid = document.getElementById('notesGrid');
  const res = await fetch('{{ route("notes.list") }}');
  const notes = await res.json();

  grid.innerHTML = '';
  if (!notes.length) {
    grid.innerHTML = '<div class="text-[#e5e5e5]">No notes yet.</div>';
    return;
  }

  notes.forEach(note => {
    const card = document.createElement('div');
    card.className = 'rounded-lg shadow-sm p-4 space-y-2';
    card.style.backgroundColor = note.color || '#1e1e1e';

    const meta = document.createElement('div');
    meta.className = 'text-sm text-gray-300';
    meta.textContent = `${note.name} • ${new Date(note.created_at).toLocaleString()}`;

    const content = document.createElement('div');
    content.className = 'whitespace-pre-wrap text-gray-100';
    content.textContent = note.content;

    const delBtn = document.createElement('button');
    delBtn.textContent = 'Delete';
    delBtn.className = 'text-sm text-red-400 hover:underline';
    delBtn.onclick = async () => {
      if (confirm('Delete this note?')) {
        await fetch(`{{ url('/notes') }}/${note.id}`, {
          method: 'DELETE',
          headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
        });
        loadNotes();
      }
    };
    card.appendChild(meta);
    card.appendChild(content);
    card.appendChild(delBtn);
    grid.appendChild(card);
    renderLatex(content);
  });
}

document.getElementById('noteForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const payload = {
    name: form.name.value,
    content: form.content.value
  };

  await fetch('{{ route("notes.store") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN
    },
    body: JSON.stringify(payload)
  });

  form.reset();
  loadNotes();
});

document.addEventListener('DOMContentLoaded', loadNotes);
</script>
</body>
</html>