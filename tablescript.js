/* table stuff follows*/
let myTable = document.getElementById("myTable");
let degrade = document.getElementById("degrade");
function removeBlock() {
    myTable.deleteRow(0);
  }

degrade.onclick=function(){
    removeBlock();
};
