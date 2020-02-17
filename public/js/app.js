// Gestion de la barre de navigation

$(function(){
	$('.nav-link').filter(function() {
		return this.href == location.href}).addClass('active').siblings().removeClass('active');

	$('.nav-link').click(function() {
		$(this).addClass('active').siblings().removeClass('active');
	})
})

// Gestion des messages d'erreur et de succès

let flashSuccessMessage = $('#success');

let flashErrorMessage = $('#error'); 

if (flashSuccessMessage !== null) {
	flashSuccessMessage.delay(5000).fadeTo('slow', 0);
}

if (flashErrorMessage !== null) {
	flashErrorMessage.delay(5000).fadeTo('slow', 0);
}

// Gestion de la pagination

$(function(){
	$('.page-link').filter(function() {
		return this.href == location.href}).parent().addClass('active').siblings().removeClass('active');

	$('.page-link').click(function() {
		$(this).parent().addClass('active').siblings().removeClass('active');
	})
});

// Garder le Pseudo dans le localStorage pour l'afficher dans le formulaire

$('.loginSubmit').click(function() {
	let pseudo = $('#pseudo').val();
	localStorage.setItem('Pseudo', pseudo);   
})

if (localStorage.getItem('Pseudo') !== null) {
	$('#pseudo').val(function () {
        return localStorage.getItem('Pseudo');
    });
}