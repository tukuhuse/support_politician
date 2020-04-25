document.getElementById("lagislatoradd").onclick = function() {
    let inputform=document.getElementbyid("legislator");
    let cloneform=inputform.cloneNode(true);
    inputform.appendChild(clone);
};