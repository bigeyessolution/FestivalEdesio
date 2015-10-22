var gaPlugin = false;
var showVotacao = false;
var onLine = false;
var watchID = false;
var edesiolat = 0;
var edesiolng = 0;
var raio = 0;

function onDeviceReady () {
    //followPosition ();
    
    gaPlugin = window.plugins.gaPlugin;
    
    if (gaPlugin) {
        gaPlugin.init(gaSuccessHandler, gaErrorHandler, "UA-59363254-3", 10); 
    }
}

function setOnLine () { onLine = true; }

function setOffLine () { onLine = false; }

function aviso () {
    
}

function votar () {
    
}

function getInfo () {
    
}

function showHideBtnJuri () {
    
}

function isConnected () {
    
}

function followPosition () {
    watchID = navigator.geolocation.watchPosition(
            checkUserPosition, geolocationError,
    {
        enableHighAccuracy: true,
        timeout: 1000,
        maximumAge: 5000
    });
}

function checkUserPosition (position) {
    //position.coords.latitude, position.coords.longitude
    
    //
}

function geolocationError (error) {
    
}

function gaSuccessHandler() { }

function gaErrorHandler() { }

document.addEventListener("deviceready", onDeviceReady, false);
document.addEventListener("online", setOnLine, false);
document.addEventListener("offline", setOffLine, false);
