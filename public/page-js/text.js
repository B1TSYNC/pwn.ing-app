var TextScramble = (function () {
    function TextScramble(element) {
        this.element = element;
        this.chars = "!*__?#^+={}[]|<>/\\-";
        this.queue = [];
        this.frame = 0;
        this.update = this.update.bind(this);
    }
    TextScramble.prototype.setText = function (newText) {
        var _this = this;
        var oldText = this.element.innerText;
        var length = Math.max(oldText.length, newText.length);
        this.queue = [];
        for (var i = 0; i < length; i++) {
            var from = oldText[i] || "";
            var to = newText[i] || "";
            var start = Math.floor(Math.random() * 200);
            var end = start + Math.floor(Math.random() * 300);
            this.queue.push({ from: from, to: to, start: start, end: end, char: "" });
        }
        cancelAnimationFrame(this.frameRequest);
        this.frame = 0;
        this.update();
        return { then: function (callback) { return (_this.resolve = callback); } };
    };
    TextScramble.prototype.randomChar = function () {
        return this.chars[Math.floor(Math.random() * this.chars.length)];
    };
    TextScramble.prototype.update = function () {
        var output = "";
        var complete = 0;
        for (var i = 0, n = this.queue.length; i < n; i++) {
            var _a = this.queue[i], from = _a.from, to = _a.to, start = _a.start, end = _a.end, char = _a.char;
            if (this.frame >= end) {
                complete++;
                output += to;
            }
            else if (this.frame >= start) {
                if (!char || Math.random() < 0.28) {
                    char = this.randomChar();
                    this.queue[i].char = char;
                }
                output += "<span class=\"cspt\">".concat(char, "</span>");
            }
            else {
                output += from;
            }
        }
        this.element.innerHTML = output;
        if (complete !== this.queue.length) {
            this.frameRequest = requestAnimationFrame(this.update);
            this.frame++;
        }
        else {
            if (this.resolve) {
                this.resolve();
            }
        }
    };
    return TextScramble;
}());
var phrases = [
    "Conduct surveillance on sites anonymously",
    "Watch your email address for data breaches",
    "One of the best data & intel resources",
    "Easily filter for information with our Muti-Purposed API",
    "Take down websites with ease",
    "Simultaneously filling in for breached",
    "Gather PII by using our scraper API",
    "No restrictions unlike haveibeenpwed",
    "(more data than them as well)",
    "DMCA free fediverse",
    "Fed-Free",
    "Get back at the guy that called you gay",
    "Power over IntelX and their spyware",
];
var element = document.querySelector(".hero-text-description");
var textScramble = new TextScramble(element);
var counter = 0;
var animateText = function () {
    var callback = function () { return setTimeout(animateText, 800); };
    var result = textScramble.setText(phrases[counter]);
    result.then(callback);
    counter = (counter + 1) % phrases.length;
};
animateText();
