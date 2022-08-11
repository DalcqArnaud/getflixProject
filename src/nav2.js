fetch('nav2.php')
.then(res => res.text())
.then(text => {
    let oldelem = document.querySelector("#nav");
    // let newelem = document.querySelector("nav");
    oldelem.innerHTML = text;
    // oldelem.parentNode.replaceChild(newelem,oldelem);
    
})