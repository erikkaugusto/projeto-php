const API = 'http://177.44.248.85/ahlert/projeto/backend/marcas';

async function carregaLista() {
    try {
        const res = await fetch(API);
        const marcas = await res.json();
        const tbody = document.getElementById('tabelabody');
        tbody.innerHTML = '';
        for (let i = 0; i < marcas.length; i++) {
            const m = marcas[i];
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${m.id}</td>
            <td>${m.nome}</td>
            <td>${m.anofundacao}</td>
            <td>${m.pais}</td>
            <td>${m.ativo}</td>
            <td>
            <a href="editaMarca.html?id=${m.id}">Editar</a> |
            <button onclick="excluir(${m.id})">Excluir</button>
            </td>`;
            tbody.appendChild(tr);
        }
    } catch (err) {
        alert('Erro ao carregar marcas: ' + err);
    }
}

async function excluir(id) {
    if (!confirm(`Confirma excluir marca ${id}?`)) return;

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