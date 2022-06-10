const electron = require('electron');
const { app, BrowserWindow, TouchBarColorPicker } = require('electron');
const path = require('path');

var port = '8000', host = '127.0.0.1';
const serverURL = `http://schemify.azuolynogimnazija.lt`;

function createWindow() {

    const { width, height } = electron.screen.getPrimaryDisplay().workAreaSize;

    const win = new BrowserWindow({
        width: width,
        height: height,
    });
    
    win.loadFile('index.html');
}

app.whenReady().then(() => {
    createWindow();
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

app.on('activate', () => {
    if (win === null) createWindow();
});