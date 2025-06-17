USE historical_apologies;

INSERT INTO Figures(name, style) VALUES
('Napoleon Bonaparte', 'arrogant'),
('Julius Caesar', 'arrogant'),
('George Washington', 'stoic'),
('Cleopatra', 'proper'),
('Winston Churchill', 'stoic'),
('Theodore Roosevelt', 'blunt'),
('Queen Victoria', 'proper'),
('Genghis Khan', 'blunt'),
('Abraham Lincoln', 'stoic'),
('Alexander the Great', 'arrogant'),
('Kim Jong-il', 'arrogant unhinged'),
('Queen Elizabeth I', 'proper'),
('Benito Mussolini', 'arrogant unhinged');

INSERT INTO WordBank (word_type, content) VALUES
/* Figures */
('figure', 'Napoleon Bonaparte'),
('figure', 'Julius Caesar'),
('figure', 'George Washington'),
('figure', 'Cleopatra'),
('figure', 'Winston Churchill'),
('figure', 'Theodore Roosevelt'),
('figure', 'Queen Victoria'),
('figure', 'Genghis Khan'),
('figure', 'Abraham Lincoln'),
('figure', 'Alexander the Great'),
('figure', 'Kim Jong-il'),
('figure', 'Queen Elizabeth I'),
('figure', 'Benito Mussolini'),

/* Recipients */
('recipient', 'the citizens of Rome'),
('recipient', 'my beloved people'),
('recipient', 'the disappointed masses'),
('recipient', 'your esteemed council'),
('recipient', 'the disgruntled goat farmer'),
('recipient', 'the island of Tortuga'),

/* Actions */
('action', 'invading your territory'),
('action', 'burning down the embassy'),
('action', 'mistaking you as a threat'),
('action', '"repurposing" your horses'),

/* Places */
('place', 'the eastern provinces'),
('place', 'the royal garden'),
('place', 'your ancestral homeland'),
('place', 'the state of Kansas'),
('place', 'that one cave absolutely crammed FULL of bats'),

/* Consequences */
('consequence', 'sank the economy'),
('consequence', 'caused national weeping'),
('consequence', 'ruined Tuesday forever'),
('consequence', 'started a new war'),
('consequence', 'obliterated 24% of the population'),

/* Justifications */
('justification', 'the stars aligned'),
('justification', 'it was foretold in my dreams'),
('justification', 'my advisors misread the prophecy'),
('justification', 'I thought it would be funny'),

/* Talents */
('talent', 'do up to seven stomach crunches'),
('talent', 'sneeze louder than everyone else'),
('talent', 'predict disasters shortly after they happen'),
('talent', 'become gray at will'),
('talent', 'domesticate some animals'),
('talent', 'use a human hand almost as efficiently as a shovel'),

/* Facts */
('fact', 'my uncanny ability to fold napkins symmetrically'),
('fact', 'my highly consistent penmanship under cannon fire'),
('fact', 'the way I can spot a pigeon from 400 meters away'),
('fact', 'that I once donated to charity'),
('fact', 'that one time I threw a molotov cocktail through the window of a 7/11');

INSERT INTO Feats(figure_id, content) VALUES
(1, 'leading the French army to dominate Europe during the early 19th century'),
(1, 'crowning myself Emperor in front of the Pope, then placing the crown on my own head'),
(1, 'established the Napoleonic Code, a legal framework still influencing many countries today'),
(2, 'conquering Gaul and bringing it into the Roman fold'),
(2, 'being named dictator for life (briefly) before being stabbed a lot'),
(2, 'writing Commentaries on the Gallic War in the third person, for dramatic flair or perhaps for political propoganda'),
(3, 'leading the Continental Army to victory against the British'),
(3, 'voluntarily stepping down from power twice'),
(3, 'refusing to be made king, even when it was basically offered'),
(4, 'mastering multiple languages and ruling Egypt with sharp political skill'),
(4, 'arranging a meeting with Caesar by being smuggled inside a carpet'),
(4, 'aligning Egypt''s interests with both Caesar and Mark Antony'),
(5, 'leading Britain through the darkest days of World War II'),
(5, 'delivering speeches that rallied a nation and echoed throughout history'),
(5, 'winning a Nobel Prize in Literature for historical and biographical writing'),
(6, 'expanding the national parks system to preserve American wilderness'),
(6, 'leading the Rough Riders up San Juan Hill during the Spanish-American War'),
(6, 'negotiating peace in the Russo-Japanese war'),
(7, 'reigning over the British Empire during its peak of global influence'),
(7, 'surviving multiple assassination attempts with unnerving calm'),
(7, 'becoming the symbolic figurehead of an entire era: the Victorian Age'),
(8, 'uniting the Mongol tribes into one of the largest empires in history'),
(8, 'creating a courier system that spanned Eurasia'),
(8, 'enforcing a legal code that protected religious freedom across my empire'),
(9, 'preserving the Union during the American Civil War'),
(9, 'issuing the Emancipation Proclamation to free enslaved people'),
(9, 'delivering the Gettysburg Address in under three minutes'),
(10, 'conquering territory from Greece to India before the age of 33'),
(10, 'founding more than twenty cities that bore my name'),
(10, 'never losing a single battle in over a decade of campaigns'),
(11, 'directing state propaganda to build a cult of personality'),
(11, 'ruling North Korea with absolute control over military and media'),
(11, 'being credited with miraculous accomplishments... according to official sources'),
(12, 'defeating the Spanish Armada and securing England''s naval dominance'),
(12, 'navigating religious conflict to establish Protestant England'),
(12, 'patronizing and encouraging the arts, including the works of Shakespeare'),
(13, 'founding Italian Fascism and becoming "Il Duce"'),
(13, 'modernizing Italy''s infrastructure and transport'),
(13, 'aligning Italy with Nazi Germany');
