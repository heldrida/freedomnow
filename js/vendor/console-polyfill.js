if (typeof console.log == "object" && Function.prototype.bind && console) {
    ["log","info","warn","error","assert","dir","clear","profile","profileEnd"]
        .forEach(function (method) {
            console[method] = this.call(console[method], console);
        }, Function.prototype.bind);
}