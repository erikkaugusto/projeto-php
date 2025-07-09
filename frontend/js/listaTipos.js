const API = 'http://177.44.248.85/ahlert/projeto/backend/tipos';

async function carregaLista() {
    try {
        const res = await fetch(API);
        const tipos = await res.json();
        const tbody = document.getElementById('tabelabody');
        tbody.innerHTML = '';
        for (let i = 0; i < tipos.length; i++) {
            const t = tipos[i];
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${t.id}</td>
            <td>${t.nome}</td>
            <td>${t.categoria}</td>
            <td>
            <a href="editaTipo.html?id=${t.id}">Editar</a> |
            <button onclick="excluir(${t.id})">Excluir</button>
            </td>`;
            tbody.appendChild(tr);
        }
    } catch (err) {
        alert('Erro ao carregar tipos: ' + err);
    }
}

async function excluir(id) {
    if (!confirm(`Confirma excluir tipo ${id}?`)) return;

    const res = await fetch(`${API}/${id}`, {
        method: 'DELETE'
    });

    if (res.status === 204) {
        carregaLista();
    } else {
        alert('Erro ao excluir');
    }
}

carregaLista();