const API = 'http://177.44.248.85/ahlert/projeto/backend/veiculos';

async function carregaLista() {
    try {
        const res = await fetch(API);
        const veiculos = await res.json();
        const tbody = document.getElementById('tabelabody');
        tbody.innerHTML = '';
        for (let i = 0; i < veiculos.length; i++) {
            const v = veiculos[i];
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${v.id}</td>
            <td>${v.marca}</td>
            <td>${v.modelo}</td>
            <td>${v.placa}</td>
            <td>${v.ano}</td>
            <td>${v.cor}</td>
            <td>${v.tipo}</td>
            <td>${v.status}</td>
            <td>
            <a href="edita.html?id=${v.id}">Editar</a> |
            <button onclick="excluir(${v.id})">Excluir</button>
            </td>`;
            tbody.appendChild(tr);
        }
    } catch (err) {
        alert('Erro ao carregar veículos: ' + err);
    }
}

async function excluir(id) {
    if (!confirm(`Confirma excluir veículo ${id}?`)) return;

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