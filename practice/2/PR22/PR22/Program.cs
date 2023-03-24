using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR22
{
    class CaesarCipher
    {
        private static string alphabet = "абвгдеёжзийклмнопрстуфхцчшщъыьэюя";

        public static string encryption(string chars)
        {
            var res = new StringBuilder();
            for (int i = 0; i < chars.Length; i++)
                for (int j = 0; j < alphabet.Length; j++)
                    if (chars[i] == alphabet[j]) res.Append(alphabet[(j + 3) % alphabet.Length]);

            return res.ToString();
        }
        public static string decryption(string cryptchars)
        {
            var res = new StringBuilder();
            for (int i = 0; i < cryptchars.Length; i++)
                for (int j = 0; j < alphabet.Length; j++)
                    if (cryptchars[i] == alphabet[j]) res.Append(alphabet[(j - 3 + alphabet.Length) % alphabet.Length]);

            return res.ToString();
        }
    }
    class Program
    {
        static void Main(string[] args)
        {
            //Приветствие
            Console.Write("Вас приветствует Цезеригма 2000" +
                "\nКраткая информация:" +
                "\nШифровка/Дешифровка текстов на шифре Цезеря" +
                "\nРасшифровка или Шифрование(Р/Ш):");
            char chs = char.Parse(Console.ReadLine());

            //Выбор действия
            if(chs == 'Ш')
            {
                //Шифрование
                Console.Write("Введите ваше сообщение: ");
                string txt = Console.ReadLine();
                Console.WriteLine(CaesarCipher.encryption(txt));
            }
            else if (chs == 'Р')
            {
                //Расшифровка
                Console.Write("Введите ваше зашифрованное сообщение: ");
                string crypt = Console.ReadLine();
                Console.WriteLine(CaesarCipher.decryption(crypt));
            }
            else
            {
                //Вслучуе если пользователь неправильно ввёл букву, то происходит закрытие
                Environment.Exit(0);
            }

            Console.ReadKey(true);
        }
    }
}
