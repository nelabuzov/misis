using System;

namespace PW3
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
            Console.Write("Шифр Цезаря" +
                "\nКраткая информация:" +
                "\nШифровка\Дешифровка текстов" +
                "\nРасшифровка или Шифрование (Р/Ш): ");
            char caesar = char.Parse(Console.ReadLine());

            if(caesar == 'Ш')
            {
                Console.Write("Введите сообщение: ");
                string txt = Console.ReadLine();
                Console.WriteLine(CaesarCipher.encryption(txt));
            }
            else if (caesar == 'Р')
            {
                Console.Write("Введите зашифрованное сообщение: ");
                string crypt = Console.ReadLine();
                Console.WriteLine(CaesarCipher.decryption(crypt));
            }
            else
            {
                Environment.Exit(0);
            }

            Console.ReadKey(true);
        }
    }
}
