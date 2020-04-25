document.getElementById("lagislatoradd").onclick = function() {
    let inputform=document.getelementbyid("legislator");
    let cloneform=inputform.cloneNode(true);
    inputform.appendChild(clone);
};