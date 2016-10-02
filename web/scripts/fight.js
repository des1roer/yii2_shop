$(function () {
    var hero =
            {
                attack: 10,
                hp: 100,
                def: 1,
                luck: 1
            };

    var enemy =
            {
                attack: 9,
                hp: 110,
                def: 1,
                luck: 1
            };

    var hlt = Math.max(hero.hp, enemy.hp);
    var i = 0;
    var winner = null;
    while (hlt > 0)
    {
        enemy.hp -= hero.attack * (1 + hero.luck / 100);
        hero.hp -= enemy.attack * (1 + enemy.luck / 100);
        hlt = Math.min(hero.hp, enemy.hp);
        winner = (enemy.hp > hero.hp) ? 'enemy' : 'hero';
        $('#fight').append(winner, hero.hp, enemy.hp, '<br/>');       
        i++;
    }
});

