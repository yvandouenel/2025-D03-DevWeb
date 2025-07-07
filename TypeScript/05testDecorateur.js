"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
function loggedMethod(target, propertyKey, descriptor) {
    let originalMethod = descriptor.value;
    descriptor.value = function (...args) {
        console.log(`Called ${propertyKey} with args: ${JSON.stringify(args)}`);
        let result = originalMethod.apply(this, args);
        console.log(`Method ${propertyKey} returned ${JSON.stringify(result)}`);
        return result;
    };
    return descriptor;
}
class Person {
    constructor(name) {
        this.name = name;
    }
    greet(test) {
        console.log(`Hello, my name is ${this.name}.`);
        return 1;
    }
}
__decorate([
    loggedMethod,
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [String]),
    __metadata("design:returntype", Number)
], Person.prototype, "greet", null);
const p = new Person("Ron");
p.greet("Toto");
