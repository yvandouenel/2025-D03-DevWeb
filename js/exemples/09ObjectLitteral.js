const bob = {
  "name": "Bob",
  "age": 87,
  "weight": 78,
  introduceMyself: function () {
    console.log(`Bonjour, je m'appelle ${this.name}`);
  }
}
console.log(`bob`, bob.name);
console.log(`bob`, bob["name"]);

bob.introduceMyself();