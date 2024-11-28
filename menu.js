
const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

darkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
})

Orders.forEach(order => {

});

document.getElementById('contratos').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-contratos');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('login').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-login');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('banco-de-horas').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-Banco');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('avaliacao').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-avaliacao');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('cargo').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-cargo');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('folha-de-pagamento').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-folha');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('folha-de-ponto').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-ponto');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('fornecedores').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-fornecedores');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

document.getElementById('funcionarios').addEventListener('click', function() {
    var submenu = document.getElementById('submenu-funcionarios');
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});



