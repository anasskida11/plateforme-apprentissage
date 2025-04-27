<?php include '../../includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 rainbow-text">Exercice : Les Accords</h1>
    <div class="text-center mb-4">
        <button class="btn btn-primary" onclick="window.location.href='index.php'">Retour</button>
    </div>
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <div id="accord-question" class="mb-3 h4"></div>
        <div id="accord-choices" class="mb-3"></div>
        <div id="accord-feedback" class="mb-3"></div>
        <div>Score : <span id="accord-score">0</span></div>
    </div>
</div>

<style>
.rainbow-text {
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow 20s linear infinite;
    background-size: 400%;
}
@keyframes rainbow {
    0% { background-position: 0% 50%; }
    100% { background-position: 400% 50%; }
}
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.btn-choice {
    margin: 8px;
    min-width: 120px;
}
</style>

<script>
const accordQuestions = [
    {
        phrase: "Le chat est [noir] (féminin)",
        options: ["noire", "noir", "noirs", "noires"],
        answer: "noire"
    },
    {
        phrase: "Les enfants sont [heureux] (féminin pluriel)",
        options: ["heureux", "heureuse", "heureuses", "heureuxs"],
        answer: "heureuses"
    },
    {
        phrase: "La maison est [grand] (féminin)",
        options: ["grande", "grand", "grands", "grandes"],
        answer: "grande"
    },
    {
        phrase: "Les chiens sont [fatigué] (masculin pluriel)",
        options: ["fatigués", "fatiguée", "fatiguées", "fatigué"],
        answer: "fatigués"
    },
    {
        phrase: "La fleur est [beau] (féminin)",
        options: ["belle", "beau", "beaux", "belles"],
        answer: "belle"
    },
    {
        phrase: "Les filles sont [gentil] (féminin pluriel)",
        options: ["gentilles", "gentil", "gentille", "gentils"],
        answer: "gentilles"
    }
];
let accordScore = 0;
let accordIndex = 0;

function showAccordQuestion() {
    if (accordIndex >= accordQuestions.length) {
        document.getElementById('accord-question').textContent = "Bravo ! Tu as terminé l'exercice.";
        document.getElementById('accord-choices').innerHTML = '';
        document.getElementById('accord-feedback').textContent = '';
        speak("Bravo ! Tu as terminé l'exercice.");
        return;
    }
    const q = accordQuestions[accordIndex];
    document.getElementById('accord-question').innerHTML = q.phrase.replace('[', '<strong>[').replace(']', ']</strong>');
    speak(q.phrase.replace('[', '').replace(']', ''));
    const choicesDiv = document.getElementById('accord-choices');
    choicesDiv.innerHTML = '';
    q.options.forEach(opt => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary btn-choice';
        btn.textContent = opt;
        btn.onclick = () => checkAccordAnswer(opt);
        choicesDiv.appendChild(btn);
    });
}
function checkAccordAnswer(selected) {
    const q = accordQuestions[accordIndex];
    const feedback = document.getElementById('accord-feedback');
    if (selected === q.answer) {
        accordScore += 10;
        feedback.textContent = 'Bravo !';
        feedback.style.color = 'green';
        speak('Bravo !');
        accordIndex++;
        setTimeout(() => {
            feedback.textContent = '';
            showAccordQuestion();
        }, 900);
    } else {
        feedback.textContent = 'Essaie encore !';
        feedback.style.color = 'red';
        speak('Essaie encore !');
    }
    document.getElementById('accord-score').textContent = accordScore;
}
function speak(text) {
    const utterance = new window.SpeechSynthesisUtterance(text);
    utterance.lang = 'fr-FR';
    utterance.rate = 0.95;
    window.speechSynthesis.speak(utterance);
}
showAccordQuestion();
</script>

<?php include '../../includes/footer.php'; ?> 