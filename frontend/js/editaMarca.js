const API = 'http://177.44.248.85/ahlert/projeto/backend/marcas';
// pega o ID através da URL
const queryString = new URLSearchParams(location.search);
const id = queryString.get('id');
const form = document.getElementById('form');
const idInput = document.getElementById('id');
const nomeInput = document.getElementById('nome');
const anoInput = document.getElementById('anofundacao');
const paisInput = document.getElementById('pais');
const ativoInput = document.getElementById('ativo');

async function carregaMarcas() {
    try {
        const res = await fetch(`${API}/${id}`);
        if (res.ok) {
            const m = await res.json();
            idInput.value = m.id;
            nomeInput.value = m.nome;
            anoInput.value = m.anofundacao;
            paisInput.value = m.pais;
            ativoInput.value = m.ativo;
        } else {
            throw new Error('Marca não encontrada');
        }
    } catch (err) {
        alert('Erro ao carregar: ' + err);
        location.href = '../index.html';
    }
}

form.addEventListener('submit', async e => {
    // pausa o envio do submit para controlarmos manualmente
    e.preventDefault();

    const payload = {
        nome: nomeInput.value,
        anofundacao: anoInput.value,
        pais: paisInput.value,
        ativo: ativoInput.value
    };

    try {
        const res = await fetch(`${API}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) {
            window.location.href = '../index.html';
        } else {
            throw new Error(res.statusText);
        }
    } catch (err) {
        alert('Erro ao atualizar: ' + err);
    }
});

carregaMarcas();