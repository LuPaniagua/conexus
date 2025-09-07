@extends('layouts.app')
 
@section('content')
<link rel="stylesheet" href="{{ asset('css/laudo.css') }}">
 
@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px auto; width: 80%; text-align: center;">
        {{ session('success') }}
    </div>
@endif
 
<main>
    <div class="branco">
        <h1>Cadastro de laudo</h1>
        <form action="{{ route('laudo.store') }}" method="POST" enctype="multipart/form-data" id="laudoForm">
            @csrf
            <div class="form-row">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Nome" required maxlength="120">
 
                <label for="data-nascimento">Data de nascimento:</label>
                <input type="date" id="data-nascimento" name="data-nascimento" required>
 
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" placeholder="RG" required maxlength="10">
 
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" required maxlength="11">
            </div>
 
            <div class="form-row">
                <label for="medico">Nome do médico:</label>
                <input type="text" id="medico" name="medico" placeholder="Nome do médico" required maxlength="120">
 
                <label for="crm">CRM:</label>
                <input type="text" id="crm" name="crm" placeholder="CRM" required maxlength="10">
 
                <label for="especialidade">Especialidade do médico:</label>
                <input type="text" id="especialidade" name="especialidade" placeholder="Especialidade" required maxlength="120">
 
                <label for="contato-medico">Contato do médico:</label>
                <input type="text" id="contato-medico" name="contato-medico" placeholder="Contato do médico" required maxlength="15">
            </div>
 
            <div class="form-row">
                <label for="detalhes">Detalhes sobre o atendimento:</label>
                <textarea id="detalhes" name="detalhes" required maxlength="1000"></textarea>
            </div>
 
            <div class="form-row">
                <label for="diagnostico">Diagnóstico:</label>
                <input type="text" id="diagnostico" name="diagnostico" required maxlength="120">
            </div>
 
            <div class="form-row file-row">
                <label for="arquivo-pdf">Adicionar PDF:</label>
                <button type="button" class="file-button" onclick="document.getElementById('arquivo-pdf').click()">Escolher PDF</button>
                <input type="file" id="arquivo-pdf" name="arquivo-pdf" accept="application/pdf" style="display:none;" onchange="updateFileName()">
                <span id="file-name">Nenhum arquivo selecionado</span>
            </div>
 
            <button type="submit" class="pdf-button">Enviar</button>
        </form>
    </div>
</main>
 
<footer>
    <img src="{{ asset('src/cerebro.jpg') }}" alt="Ícone de Cérebro" class="brain-icon">
</footer>
 
<!-- Scripts -->
<script>
    function updateFileName() {
        const input = document.getElementById('arquivo-pdf');
        const fileName = input.files.length > 0 ? input.files[0].name : 'Nenhum arquivo selecionado';
        document.getElementById('file-name').textContent = fileName;
    }
 
    // Bloqueia números nos campos de texto específicos
    function bloquearNumeros(event) {
        const tecla = event.key;
        if (/\d/.test(tecla)) {
            event.preventDefault();
        }
    }
 
    document.getElementById('nome').addEventListener('keypress', bloquearNumeros);
    document.getElementById('medico').addEventListener('keypress', bloquearNumeros);
    document.getElementById('especialidade').addEventListener('keypress', bloquearNumeros);
 
    // Limita a 10 caracteres no campo de data
    const dataInput = document.getElementById('data-nascimento');
    dataInput.addEventListener('input', function () {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
</script>
@endsection
