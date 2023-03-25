using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR34
{

    // Класс отвечающий за отправку сообщений
    class SmsMessage
    {

        // Инициализация свойств класса
        private string messagetxt;
        private double firstprice;
        private double secondprice;
        private int maxlenghtmsg;

        public string MessageText { set { messagetxt = CheckLongMess(value); } }
        public double Price { get { return MsgPrice(messagetxt); } }
        public double FirstPrice { set { firstprice = value; } }
        public double SecondPrice { set { secondprice = value; } }
        public int MaxLenghtMsg {set { maxlenghtmsg = value; } }

        // Конструктор с приемом свойств
        public SmsMessage(double fprice, double sprice, int msxlnght)
        {
            FirstPrice = fprice;
            SecondPrice = sprice;
            MaxLenghtMsg = msxlnght;
        }

        // Перегрузка конструктора без аргументов
        public SmsMessage()
        {
            FirstPrice = 1.5;
            SecondPrice = 0.5;
            MaxLenghtMsg = 250;
        }

        // Метод проверки длинны сообщения
        private string CheckLongMess(string msg1)
        {
            if (msg1.Length > maxlenghtmsg)
            {
                return msg1.Substring(0, msg1.Length - (msg1.Length - maxlenghtmsg));
            }
            else {
                return msg1;
                    }
        }

        // Метод расчета цены сообщения
        private double MsgPrice(string msg2)
        {
            if (msg2.Length < 65)
            {
                return msg2.Length * firstprice;
            }
            return msg2.Length * secondprice;
        }
    }

    // Клиентский код
    class Program
    {
        static void Main(string[] args)
        {

            // Приветствие
            Console.Write("Вас приветсвует Телеграф-80000! Мы можем отправить ваше сообщение любому человеку, но только до 250 символов." +
                "\nТарифы:" +
                "\nИХ БОЛЬШЕ НЕТ! Но вы можете использовать старые или вести свои" +
                "\nСообщения < 65 символов стоят 1.5;" +
                "\nСообщения > 65 символов стоят 0.5 рублей." +
                "\nВведите ваш ответ (С/В): ");

            // Ввод выбора пользователя
            char answ = char.Parse(Console.ReadLine());

            // Ввод пользовтаельского сообщения
            Console.WriteLine("Введите ваше сообщение (max:250 по старому):");
            string msg = Console.ReadLine();

            // Операция по отправке
            if(answ == 'С' | answ == 'с')
            {

                // Если используется старый формат
                SmsMessage smstext = new SmsMessage();
                smstext.MessageText = msg;

                // Вывод о состоянии отправки
                Console.Write($"\nЦена сообщения: {smstext.Price}");
            }
            else if(answ == 'В' | answ == 'в')
            {

                // Если используется собственный формат
                Console.Write("Введите вашу цену для сообщения до 65 символов, после и максимальную длину сообщения (через пробел): ");

                // Получение данных формата
                string srv = Console.ReadLine();
                string[] num = srv.Split(new char[] { ' ' }, StringSplitOptions.RemoveEmptyEntries);

                // Инициализация объекта с конструктором
                SmsMessage smstext = new SmsMessage(Convert.ToDouble(num[0]), Convert.ToDouble(num[1]), Convert.ToInt32(num[2]));
                smstext.MessageText = msg;

                // Вывод
                Console.Write($"\nЦена сообщения: {smstext.Price}");
            }
            Console.ReadKey(true);
        }
    }
}
