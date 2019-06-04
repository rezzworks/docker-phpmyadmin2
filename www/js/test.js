


// Constructor Function
function Circle(radius) {
    this.radius = radius;
    this.draw = function() {
        console.log('draw');
    }
}

Circle.call({}, 1);
Circle.apply({}, [1,2,3]);

const another = new Circle(1); 

let x = { value: 10};
let y = x;

x.value = 20;

let obj = { value: 10 };

function increase(obj) {
    number++;
}

increase(obj);
console.log(obj);


