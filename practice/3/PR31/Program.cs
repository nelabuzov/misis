using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR31
{

    // Класс для отправки сообщений
    class SmsMessage
    {

     // Инициализация свойств класса
     private string messagetxt; 
     public string MessageText { get {  return messagetxt; }  set { messagetxt = CheckLongMess(value); } }
     public double Price { get { return MsgPrice(messagetxt); }}

        // Метод проверки длины сообщения
        private string CheckLongMess(string msg1)
        {
            if (msg1.Length > 250)
            {
                return msg1.Substring(0, msg1.Length - (msg1.Length - 250));
            }
            return msg1;
        }

        // Метод расчета цены сообщения
        public double MsgPrice(string msg2)
        {
            if (msg2.Length < 65)
            {
                return msg2.Length * 1.5;
            }
            return msg2.Length * 0.5;
        }
    }

    // Клиентский код
    class Program
    {
        static void Main(string[] args)
        {

            // Инициализация объекта
            SmsMessage smstext = new SmsMessage();

            // Приветствие
            Console.Write("Вас приветсвует телеграф-40000! Мы можем отправить ваше сообщение любому человеку, но только до 250 символов." +
                "\nТарифы:" +
                "\nСообщения < 65 символов стоят 1.5;" +
                "\nСообщения > 65 символов стоят 0.5 рублей." +
                "\nВведите ваше сообщение (до 250 символов):");

            // Ввод сообщения пользователя
            smstext.MessageText = Console.ReadLine();

            // Вывод о состоянии отправки
            Console.Write($"Длина вашего сообщения: {smstext.MessageText.Length}:" +
                $"\nЦена сообщения: {smstext.Price}");

            Console.ReadKey(true);
        }
    }
}
