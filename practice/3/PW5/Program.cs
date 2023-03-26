using System;

namespace PW5
{
    class SmsMessage
    {
        private string messageTXT;
        private double firstprice;
        private double secondprice;
        private int maxlengthmessage;

        public string MessageText { set { messageTXT = CheckLongMess(value); } }
        public double Price { get { return MsgPrice(messageTXT); } }
        public double FirstPrice { set { firstprice = value; } }
        public double SecondPrice { set { secondprice = value; } }
        public int MaxLengthMessage {set { maxlengthmessage = value; } }

        public SmsMessage(double fprice, double sprice, int maxLength)
        {
            FirstPrice = fprice;
            SecondPrice = sprice;
            MaxLengthMessage = maxLength;
        }

        public SmsMessage()
        {
            FirstPrice = 1.5;
            SecondPrice = 0.5;
            MaxLengthMessage = 250;
        }

        private string CheckLongMess(string message1)
        {
            if (message1.Length > maxlengthmessage)
            {
                return message1.Substring(0, message1.Length - (message1.Length - maxlengthmessage));
            }
            else {
                return message1;
            }
        }

        private double MsgPrice(string message2)
        {
            if (message2.Length < 65)
            {
                return message2.Length * firstprice;
            }
            return message2.Length * secondprice;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Телеграф отправить до 250 символов." +
                "\nТарифы: " +
                "\nСообщения < 65 символов стоят 1.5" +
                "\nСообщения > 65 символов стоят 0.5 рублей" +
                "\nВведите ваш ответ (С/В): ");

            char answer = char.Parse(Console.ReadLine());

            Console.WriteLine("Введите ваше сообщение: ");
            string sms = Console.ReadLine();

            if(answer == 'С' | answer == 'с')
            {
                SmsMessage smsText = new SmsMessage();
                smsText.MessageText = sms;
                Console.Write($"\nЦена сообщения: {smsText.Price}");
            }
            else if(answer == 'В' | answer == 'в')
            {
                Console.Write("Введите цену для сообщения до 65 символов и максимальную длину через пробел: ");

                string serve = Console.ReadLine();
                string[] num = serve.Split(new char[] { ' ' }, StringSplitOptions.RemoveEmptyEntries);

                SmsMessage smsText = new SmsMessage(Convert.ToDouble(num[0]), Convert.ToDouble(num[1]), Convert.ToInt32(num[2]));
                smsText.MessageText = sms;

                Console.Write($"\nЦена сообщения: {smsText.Price}");
            }
            Console.ReadKey(true);
        }
    }
}
