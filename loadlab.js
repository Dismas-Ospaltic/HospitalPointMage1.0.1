function changeLabDet(){
    const display = document.querySelector("#patient-view-card .field-form .det-container"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('PN');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","Loadlabdet.php?PN="+paramValue,false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
}  

// function changeLabDetComp(){
//     const display = document.querySelector("#patient-view-card-complete .field-form .det-container"),
//     urlParams = new URLSearchParams(window.location.search),
//     paramValue = urlParams.get('PN');

//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.open("GET","LabloadComp.php?PN="+paramValue,false);
//      xmlhttp.send(null);
//      display.innerHTML=xmlhttp.responseText;
// }  