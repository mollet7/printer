<script>
    // input from webpage.
  window.addEventListener('load',function() {
    const table = document.getElementById('dataTable');
    const numRows = table.rows.length;

  

  for (let i = 1; i < numRows; i++){
    const buyDateElement = document.getElementById('buyDate'+ i);
    const buyDateId = buyDateElement.id;
    console.log(buyDateId); 
    console.log(buyDateElement.textContent);
    

    const useDateElement = document.getElementById('useDate'+ i);
    const useDateId = useDateElement.id;
    console.log(useDateId); 

    const replaceDateElement = document.getElementById('replaceDate'+ i);
    const replaceDateId = replaceDateElement.id;
    console.log(replaceDateId); 

    const toner_statusElement = document.getElementById('toner_status'+ i);
    const toner_statusId = toner_statusElement.id;
    let status;

    
    //console.log(toner_statusId);
    
    const defaultDate = '2023-01-01';
    if (buyDateElement.innerHTML > useDateElement.innerText) {
        
        document.getElementById(toner_statusId).innerText = "NOT USED";
        status = 1;
        document.getElementById(toner_statusId).style.backgroundColor = "#aab7b8";
        var notUsed = 'NOT USED';
        localStorage.setItem('notUsed', notUsed);
        
        

    } else if (useDateElement.innerHTML > defaultDate ){
        
        document.getElementById(toner_statusId).innerText = "IN USE";
        status = 2;
        document.getElementById(toner_statusId).style.backgroundColor = "#31eb0c";
        var inUse = "IN USE";
        localStorage.setItem('inUse', inUse);
        
        
        
    } else if (replaceDateElement.innerHTML > defaultDate){
        
        document.getElementById(toner_statusId).innerText = "REPLACED";
        status = 3;
        document.getElementById(toner_statusId).style.backgroundColor = "yellow";
        var replace = 'REPLACED';
        localStorage.setItem('replace', replace);
    } else {
        console.log('Wrong!');
    }
  }
});

   
</script>