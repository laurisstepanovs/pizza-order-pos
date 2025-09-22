const statusToClasses = new Map([
    ["Pending", {text: "text-yellow-500", ping: "bg-yellow-400 opacity-75", dot: "bg-yellow-500"}],
    ["Cooking", {text: "text-orange-500", ping: "bg-orange-400 opacity-75", dot: "bg-orange-500"}],
    ["Ready", {text: "text-green-500", ping: "bg-green-400 opacity-75", dot: "bg-green-500"}]
]);

export default statusToClasses;
