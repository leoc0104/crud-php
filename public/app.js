document.getElementById('show-word-form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const wordId = document.getElementById('show-id').value;
    const response = await fetch(`/words/${wordId}`, {
        method: 'GET',
    });
    const data = await response.json();
    const wordList = document.getElementById('show-word-list');
    wordList.innerHTML = '<ul>' + `
        <li>
            <strong>${data.name}</strong> (${data.translation}) <br>
            Matéria: ${data.subject} <br>
            Contexto: ${data.context_applied}
        </li>` + '</ul>';
});

document.getElementById('list-words').addEventListener('click', async () => {
    const response = await fetch('/words');
    const data = await response.json();
    const wordList = document.getElementById('word-list');
    wordList.innerHTML = '<ul>' + data.map(word => `
        <li>
            <strong>${word.name}</strong> (${word.translation}) <br>
            Matéria: ${word.subject} <br>
            Contexto: ${word.context_applied}
        </li>`).join('') + '</ul>';
});

document.getElementById('add-word-form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const translation = document.getElementById('translation').value;
    const subject = document.getElementById('subject').value;
    const context_applied = document.getElementById('context_applied').value;

    const response = await fetch('/words', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, translation, subject, context_applied })
    });

    const data = await response.json();
    alert(data.message);
});

document.getElementById('update-word-form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const wordId = document.getElementById('update-id').value;
    const name = document.getElementById('new-name').value;
    const translation = document.getElementById('new-translation').value;
    const subject = document.getElementById('new-subject').value;
    const context_applied = document.getElementById('new-context_applied').value;

    const response = await fetch(`/words/${wordId}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, translation, subject, context_applied })
    });

    const data = await response.json();
    alert(data.message);
});

document.getElementById('delete-word-form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const wordId = document.getElementById('delete-id').value;

    const response = await fetch(`/words/${wordId}`, {
        method: 'DELETE',
    });

    const data = await response.json();
    alert(data.message);
});
