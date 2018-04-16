<div id='formInfoUtente'>
    <div class='element-container'>
        ID Utente<input type="text" readonly="true" id="idUtente"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('idUtente')">
    </div>
    <div class='element-container'>
        Email<input type="text" readonly="true" id="email"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('email')">
    </div>
    <div class='element-container'>
        Nome<input type="text" readonly="true" id="nome"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('nome')">
    </div>
    <div class='element-container'>
        Cognome<input type="text" readonly="true" id="cognome"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('cognome')">
    </div>
    <div class='element-container'>
        Password<input type="text" readonly="true" id="password"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('password')">
    </div>
    <div class='element-container'>
        Codice Referral<input type="text" readonly="false" id="referral"></input>
        <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('referral')">
    </div>
    <input type="submit" id="submit" value="Salva Modifiche"></input>
</div class='element-container'>
<script>
    //rendo le parti di input del form utente modificabili 
function rendiModificabileFormElement(dataInput){
    var attribute=dataInput.getAttribute('readonly');
    if(attribute==true){
        dataInput.setAttribute('readonly','false');
    }
}
</script>