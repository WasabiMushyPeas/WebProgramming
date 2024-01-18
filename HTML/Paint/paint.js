let canvas;
let ctx;

function start(){
    canvas = document.getElementById("canvas");
    ctx = canvas.getContext("2d");
    ctx.fillStyle = "black";
    ctx.fillRect(10, 30, 50, 100);
}

function mouseDown(event){
    ctx.fillStyle = "red";
    ctx.fillRect(event.offsetX, event.offsetY, 10, 10);
}