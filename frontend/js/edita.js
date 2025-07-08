const API = 'http://177.44.248.85/ahlert/projeto/backend/veiculos';
// pega o ID através da URL
const queryString = new URLSearchParams(location.search);
const id = queryString.get('id');
const form = document.getElementById('form');
const idInput = document.getElementById('id');
const marcaInput = document.getElementById('marca');
const modeloInput = document.getElementById('modelo');
const placaInput = document.getElementById('placa');
const anoInput = document.getElementById('ano');
const corInput = document.getElementById('cor');
const tipoInput = document.getElementById('tipo');
const statusInput = document.getElementById('status');

async function carregaVeiculos() {
    try {
        const res = await fetch(`${API}/${id}`);
        if (res.ok) {
            const v = await res.json();
            idInput.value = v.id;
            marcaInput.value = v.marca;
            modeloInput.value = v.modelo;
            placaInput.value = v.placa;
            anoInput.value = v.ano;
            corInput.value = v.cor;
            tipoInput.value = v.tipo;
            statusInput.value = v.status;
        } else {
            throw new Error('Veículo não encontrado');
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
        marca: marcaInput.value,
        modelo: modeloInput.value,
        placa: placaInput.value,
        ano: anoInput.value,
        cor: corInput.value,
        tipo: tipoInput.value,
        status: statusInput.value
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

carregaVeiculos();