class TextScramble {
  private element: HTMLElement;
  private phrases: string[];

  constructor(element: HTMLElement) {
    this.element = element;
    this.phrases = element.dataset.words ? element.dataset.words.split(',') : [];
  }

  public setText(newText: string): Promise<void> {
    const oldText = this.element.innerText;
    return new Promise(resolve => {
      const length = Math.max(oldText.length, newText.length);
      const promiseArr: Promise<void>[] = [];
      for (let i = 0; i < length; i++) {
        const from = oldText[i] || '';
        const to = newText[i] || '';
        const offset = Math.floor(Math.random() * 40);
        const promise = new Promise<void>(resolve => setTimeout(() => {
          const chars = this.randomChars(from, to);
          this.update(chars);
          resolve();
        }, offset));
        promiseArr.push(promise);
      }
      Promise.all(promiseArr).then(() => resolve());
    });
  }

  private randomChars(from: string, to: string): string {
    const letters = 'abcdefghijklmnopqrstuvwxyz';
    const range = letters.indexOf(to) - letters.indexOf(from);
    const min = letters.indexOf(from);
    let result = '';
    for (let i = 0; i < Math.abs(range); i++) {
      const index = Math.min(Math.max(Math.floor(Math.random() * range + min), 0), 25);
      result += letters[index];
    }
    return result;
  }

  private update(chars: string): void {
    this.element.innerText = chars;
  }
}

const element = document.querySelector('.text');
if (element) {
  const phrases = element.dataset.words ? element.dataset.words.split(',') : [];
  const textScramble = new TextScramble(element);
  let counter = 0;
  const animateText = () => {
    textScramble.setText(phrases[counter]).then(() => {
      counter = (counter + 1) % phrases.length;
      setTimeout(animateText, 2500);
    });
  };
  animateText();
}
