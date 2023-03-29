// not functional yet, just for looks at the moment

const consoleInput = document.querySelector(".console-input");
const historyContainer = document.querySelector(".console-history");
const commandHistory = [];
let commandIndex = 0;

function addResult(inputAsString, output) {
  const outputAsString =
    output instanceof Array ? `[${output.join(", ")}]` : output.toString();
  const inputLogElement = document.createElement("div");
  const outputLogElement = document.createElement("div");

  inputLogElement.classList.add("console-input-log");
  outputLogElement.classList.add("console-output-log");

  inputLogElement.textContent = `> ${inputAsString}`;
  outputLogElement.textContent = outputAsString;

  historyContainer.append(inputLogElement, outputLogElement);
}

consoleInput.addEventListener("keydown", (e) => {
  const code = consoleInput.value.trim();

  if (e.key === "ArrowUp") {
    if (commandIndex > 0) {
      commandIndex--;
      consoleInput.value = commandHistory[commandIndex];
    }
    e.preventDefault();
  } else if (e.key === "ArrowDown") {
    if (commandIndex < commandHistory.length - 1) {
      commandIndex++;
      consoleInput.value = commandHistory[commandIndex];
    } else {
      commandIndex = commandHistory.length;
      consoleInput.value = "";
    }
    e.preventDefault();
  }
});

consoleInput.addEventListener("keyup", (e) => {
  const code = consoleInput.value.trim();

  if (code.length === 0) {
    return;
  }

  if (e.key === "Enter") {
    if (code === "clear" || code === "clr") {
      historyContainer.innerHTML = "";

    } else if (code === "ssh") {
      addResult(code, `usage: ssh [-46AaCfGgKkMNnqsTtVvXxYy] [-B bind_interface]
      [-b bind_address] [-c cipher_spec] [-D [bind_address:]port]
      [-E log_file] [-e escape_char] [-F configfile] [-I pkcs11]
      [-i identity_file] [-J [user@]host[:port]] [-L address]
      [-l login_name] [-m mac_spec] [-O ctl_cmd] [-o option] [-p port]
      [-Q query_option] [-R address] [-S ctl_path] [-W host:port]
      [-w local_tun[:remote_tun]] destination [command]`);
    } else if (code.startsWith("ssh ")) {
      const parts = code.split(" ");
      if (parts.length < 2) {
        addResult(code, "ssh: Missing username and host");
      } else {
        const [username, host] = parts[1].split("@");
        addResult(code, `ssh: connect to host ${username}:${host} port 22: Connection refused`);
      }
    } else {
  commandHistory.push(code);
  commandIndex = commandHistory.length;
  try {
    addResult(code, eval(code));
  } catch (err) {
    addResult(code, err);
  }
}

consoleInput.value = "";
historyContainer.scrollTop = historyContainer.scrollHeight;
}
});

