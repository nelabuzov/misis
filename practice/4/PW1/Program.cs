using System;

namespace PW1
{
    class Spell
    {
        public int Mana { get; private set; }
        private string Effect { get; set; }
        public string Name { get; private set; }

        public Spell (int mana, string effect, string name)
        {
            Mana = mana;
            Effect = effect;
            Name = name;
        }

        public string Use()
        {
            return Effect;
        }
    }

    class Magician
    {
        public string Name { get; private set; }
        public int Mana { get; private set; }

        public Magician(string name, int mana)
        {
            Name = name;
            Mana = mana;
        }

        public void CastSpell(Spell spell)
        {
            if(Mana >= spell.Mana)
            {
                Console.WriteLine($"{Name} колдует! {spell.Use()}");
                Mana -= spell.Mana;
            }
            else
            {
                Console.WriteLine($"Для использования \"{spell.Name}\" не хватает {spell.Mana-Mana} единиц маны");
            }
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Spell alohomora = new Spell(60, "Замок открывается!", "Алохомора");
            Spell vingardiumLeviosa = new Spell(60, "Предмет поднимается в воздух!", "Вингардиум-Левиоса");

            Magician garryPotter = new Magician("Гарри Поттер", 100);

            garryPotter.CastSpell(alohomora);
            garryPotter.CastSpell(vingardiumLeviosa);

            Console.ReadKey(true);
        }
    }
}
