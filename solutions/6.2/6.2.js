const defaultText = "\n" +
    "<!DOCTYPE html>\n" +
    "<html lang=\"en\">\n" +
    "<head>\n" +
    "    <meta charset=\"UTF-8\">\n" +
    "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n" +
    "    <title>Plagiatsresolution</title>\n" +
    "</head>\n" +
    "<body>\n" +
    "<header><h2 class=\"field field--name-title field--type-ds field--label-hidden\">Plagiatsresolution und -maßnahmen</h2></header>\n" +
    "\n" +
    "<div class=\"content\">\n" +
    "\n" +
    "    <div  class=\"paragraphs-items paragraphs-items-field-pcf-content paragraphs-items-field-pcf-content-full paragraphs-items-full\">\n" +
    "        <div class=\"field field-name-field-pcf-content\">\n" +
    "            <div  class=\"entity entity-paragraphs-item paragraphs-item-para-text\">\n" +
    "        <div class=\"field field--name-field-pf-text-wysiwyg field--type-text-long field--label-hidden\">\n" +
    "            <p>\n" +
    "                <strong>Resolution zum akademischen Ethos und zu den akademischen Standards</strong></p>\n" +
    "            <p>\n" +
    "                In guter Tradition und anlässlich der öffentlichen Diskussion zum Plagiatsthema sieht sich die Hochschule Bonn-Rhein-Sieg in der Pflicht, ihre Position klar und eindeutig zu bekunden und hochschulweit Maßnahmen einzuleiten.</p>\n" +
    "            <p>\n" +
    "                1. Die Hochschule Bonn-Rhein-Sieg bekennt sich mit dieser Resolution öffentlich zum akademischen Ethos und den akademischen Standards.</p>\n" +
    "            <p>\n" +
    "                2. Die Hochschule Bonn-Rhein-Sieg sieht sich verpflichtet, alle Studierende frühzeitig im Studium sowohl über den wissenschaftlichen Auftrag und den akademischen Ethos als auch über die Konsequenzen seiner Missachtung aufzuklären. In allen Studiengängen wird intensiv in die wissenschaftliche Arbeits- und Denkweise eingeführt und über den akademischen Ethos und die akademischen Standards klar und eindeutig aufgeklärt.</p>\n" +
    "            <p>\n" +
    "                3. In einer Selbstverpflichtungserklärung zum akademischen Ethos geben alle Studierende der Hochschule Bonn-Rhein-Sieg spätestens gegen Ende des ersten Studienjahres zum Ausdruck, dass sie sich von den Dozentinnen und Dozenten der Hochschule Bonn-Rhein-Sieg hinreichend über den akademischen Ethos und die akademischen Standards aufgeklärt sind und diese beachten werden.</p>\n" +
    "            <p>\n" +
    "                Der Senat befürwortete in seiner Sitzung am 03.05.2012 die Resolution in der o.g. Fassung.</p>\n" +
    "            <p>\n" +
    "                <strong>Eckpunkte zur Plagiatsprüfung</strong></p>\n" +
    "            <p>\n" +
    "                Der Senat empfiehlt:</p>\n" +
    "            <p>\n" +
    "                1. Die Aufklärung und das Bekenntnis zum akademischen Ethos und den akademischen Standards muss fester Bestandteil aller Curricula aller Studiengänge im ersten Studienjahr sein. Alle Curricula aller Studiengänge werden darauf hin geprüft und ggfs. ergänzt.</p>\n" +
    "            <p>\n" +
    "                2. Alle Abschlussarbeiten werden auf Plagiate geprüft.</p>\n" +
    "            <p>\n" +
    "                3. Alle Abschlussarbeiten mit Plagiaten werden grundsätzlich als Fehlversuch gewertet.</p>\n" +
    "            <p>\n" +
    "                4. Die Entscheidung, ob die Arbeit Plagiate enthält, liegt zuerst bei den Gutachterinnen und Gutachtern. Der Nachweis in einem Gutachten reicht.</p>\n" +
    "            <p>\n" +
    "                5. Alle Abschlussarbeiten werden grundsätzlich auch in elektronischer Form (PDF-Format und Originalformat wie Word, OpenOffice, ...) eingereicht.</p>\n" +
    "            <p>\n" +
    "                6. Alle Abschlussarbeiten ohne Sperrvermerk werden einem vom Fachbereich definierten Kreis zur Einsicht zur Verfügung gestellt. Alle Abschlussarbeiten sollten nach Möglichkeit grundsätzlich zur Veröffentlichung freigegeben werden. Wissenschaft zielt auf Veröffentlichung ab. Nichtveröffentlichung sollte nur in begründeten und durch den Prüfungsausschuss genehmigten Ausnahmefällen geschehen.</p>\n" +
    "            <p>\n" +
    "                7. Im Bereich von Seminar-, Hausarbeiten und Praktikumsberichten behält sich die Hochschule stichprobenartige Plagiatsprüfungen vor.</p>\n" +
    "            <p>\n" +
    "                <strong>Selbstverpflichtungserklärung der Studierenden:</strong></p>\n" +
    "            <p>\n" +
    "                Eine akademische Arbeit stellt eine individuelle Leistung dar, die eigenständig und allein auf Basis der im Literaturverzeichnis angegebenen Quellen erstellt wurde und in der alle Zitate als solche gekennzeichnet sind.</p>\n" +
    "            <p>\n" +
    "                \"Ich erkläre hiermit, dass ich den akademischen Ehrencodex kenne und über die Folgen einer Missachtung oder Verletzung aufgeklärt worden bin.\"</p>\n" +
    "\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "\n" +
    "</article>\n" +
    "</body>\n" +
    "</html>\n";

let text = defaultText

let stopwords = "ab, aber, abgesehen, alle, allein, aller, alles, als, am, an, andere, anderen, anderenfalls, anderer, anderes, anstatt, auch, auf, aus, aussen, außen, ausser, außer, ausserdem, außerdem, außerhalb, ausserhalb, behalten, bei, beide, beiden, beider, beides, beinahe, bevor, bin, bis, bist, bitte, da, daher, danach, dann, darueber, darüber, darueberhinaus, darüberhinaus, darum, das, dass, daß, dem, den, der, des, deshalb, die, diese, diesem, diesen, dieser, dieses, dort, duerfte, duerften, duerftest, duerftet, dürfte, dürften, dürftest, dürftet, durch, durfte, durften, durftest, durftet, ein, eine, einem, einen, einer, eines, einige, einiger, einiges, entgegen, entweder, erscheinen, es, etwas, fast, fertig, fort, fuer, für, gegen, gegenueber, gegenüber, gehalten, geht, gemacht, gemaess, gemäß, genug, getan, getrennt, gewesen, gruendlich, gründlich, habe, haben, habt, haeufig, häufig, hast, hat, hatte, hatten, hattest, hattet, hier, hindurch, hintendran, hinter, hinunter, ich, ihm, ihnen, ihr, ihre, ihrem, ihren, ihrer, ihres, ihrige, ihrigen, ihriges, immer, in, indem, innerhalb, innerlich, irgendetwas, irgendwelche, irgendwenn, irgendwo, irgendwohin, ist, jede, jedem, jeden, jeder, jedes, jedoch, jemals, jemand, jemandem, jemanden, jemandes, jene, jung, junge, jungem, jungen, junger, junges, kann, kannst, kaum, koennen, koennt, koennte, koennten, koenntest, koenntet, können, könnt, könnte, könnten, könntest, könntet, konnte, konnten, konntest, konntet, machen, macht, machte, mehr, mehrere, mein, meine, meinem, meinen, meiner, meines, meistens, mich, mir, mit, muessen, müssen, muesst, müßt, muß, muss, musst, mußt, nach, nachdem, naechste, nächste, nebenan, nein, nichts, niemand, niemandem, niemanden, niemandes, nirgendwo, nur, oben, obwohl, oder, oft, ohne, pro, sagte, sagten, sagtest, sagtet, scheinen, sehr, sei, seid, seien, seiest, seiet, sein, seine, seinem, seinen, seiner, seines, seit, selbst, sich, sie, sind, so, sogar, solche, solchem, solchen, solcher, solches, sollte, sollten, solltest, solltet, sondern, statt, stets, tatsächlich, tatsaechlich, tief, tun, tut, ueber, über, ueberall, überll, um, und, uns, unser, unsere, unserem, unseren, unserer, unseres, unten, unter, unterhalb, usw, viel, viele, vielleicht, von, vor, vorbei, vorher, vorueber, vorüber, waehrend, während, wann, war, waren, warst, wart, was, weder, wegen, weil, weit, weiter, weitere, weiterem, weiteren, weiterer, weiteres, welche, welchem, welchen, welcher, welches, wem, wen, wenige, wenn, wer, werde, werden, werdet, wessen, wie, wieder, wir, wird, wirklich, wirst, wo, wohin, wuerde, wuerden, wuerdest, wuerdet, würde, würden, würdest, würdet, wurde, wurden, wurdest, wurdet, ziemlich, zu, zum, zur, zusammen, zwischen,";
stopwords = stopwords.split(", ");

const main = document.getElementById('main')
const msg = document.getElementById('msg')
const url = document.getElementById('url');

window.onload = init();

function init() {
    main.innerHTML = text;
    compute();
}

async function fetchAndCompute(){
    let value = url.value;
    if (!value) return;
    fetch(value, {cors: "no-cors"})
        .then(res => res.text())
        .then(res => {
            text = res;
            main.innerHTML = text;
            compute();
        })
        .catch(err => {
            msg.innerText = "Sorry, could fetch Site";
            console.error(err);
        })
}

function reset() {
    text = defaultText;
    main.innerHTML = text;
    compute();
}

function compute() {
    
    const arr = text.split(/\n|>|,|\.| /).filter(x => x != "" && x != "\n");

    //filter html tags
    let x = arr.filter(word => !word.includes("<")).filter(word => !word.includes("=")).filter(word => !word.includes("--"));

    //filter stopwords
    x = x.filter(word => !(stopwords.includes(word.toLowerCase())));

    //Create Histogram with HashMap
    const map = x.reduce((acc, e) => acc.set(e, (acc.get(e) || 0) + 1), new Map());
    const sortedMap = new Map([...map.entries()].sort((a, b) => b[1] - a[1]));

    let result = Array.from(sortedMap.entries()).slice(0, 3);
    console.log(result)
    result = result.map((e) => e.join(" : "))
    console.log(result)
    msg.innerHTML = `
    <h2>Die 3 häufigesten Begriffe ohne stopwords:</h2>
    <br>
    ${result.join(", ")}
    `

}