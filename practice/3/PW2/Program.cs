using System;

namespace PW2
{
    class Message
    {
     private string messageTXT; 
     public string MessageText { get {  return messageTXT; }  set { messageTXT = CheckLong(value); } }
     public double Price { get { return Price(messageTXT); }}

        private string CheckLong(string sms)
        {
            if (sms.Length > 250)
            {
                return sms.Substring(0, sms.Length - (sms.Length - 250));
            }

            return sms;
        }

        public double Price(string msg2)
        {
            if (msg2.Length < 65)
            {
                return msg2.Length * 1.5;
            }

            return msg2.Length * 0.5;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Message smsText = new Message();
            Console.Write("Телеграф отправляет до 250 символов" +
                "\nТарифы: " +
                "\nСообщения < 65 символов стоят 1.5 рубля" +
                "\nСообщения > 65 символов стоят 0.5 рублей" +
                "\nВведите ваше сообщение (до 250 символов): ");

            smsText.MessageText = Console.ReadLine();
            Console.Write($"Длина сообщения: {smsText.MessageText.Length}" +
                $"\nЦена сообщения: {smsText.Price}");

            Console.ReadKey(true);
        }
    }
}
