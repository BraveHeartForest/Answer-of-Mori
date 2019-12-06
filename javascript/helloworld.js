console.log("Hello world!");
var str='';
for(var i=1;i<=5;i++){
    if(i==5){
        str=str+i;
        break;
    }
    str=str+i+",";
}
console.log("連番:"+str);
