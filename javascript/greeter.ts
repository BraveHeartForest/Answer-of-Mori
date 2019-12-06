class Student{
    fullName:string;
    constructor(public firstName:string,public middleInitial:string,public lastName:string){
        this.fullName = firstName+" "+middleInitial+" "+lastName;
    }
}

interface Person {
    firstName: String;
    lastName: String;
}

function greeter(person: Person) {
    return "Hello, " + person.firstName + " " + person.lastName;
}

let user = { firstName:"Jane" , lastName: "User" };
//let user = [0, 1, 2];

let student = new Student("James","M","Black");

console.log(greeter(user));
console.log(greeter(student));