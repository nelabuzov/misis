using vcs;

namespace test
{
    [TestClass]
    public class UnitTest
    {
        [TestMethod]
        public void Addition_375and512_returned()
        {
            int a = 375;
            int b = 512;
            int expected = 887;

            CalcTest c = new CalcTest();
            int actual = c.Addition(a, b);

            Assert.AreEqual(expected, actual);
        }

        [TestMethod]
        public void Subtraction_3and5_returned()
        {
            int a = 3;
            int b = 5;
            int expected = -2;

            CalcTest c = new CalcTest();
            int actual = c.Subtraction(a, b);

            Assert.AreEqual(expected, actual);
        }

        [TestMethod]
        public void Multiplication_25and73_returned()
        {
            int a = 25;
            int b = 73;
            int expected = 1825;

            CalcTest c = new CalcTest();
            int actual = c.Multiplication(a, b);

            Assert.AreEqual(expected, actual);
        }

        [TestMethod]
        public void Division_1285and5_returned()
        {
            int a = 1285;
            int b = 5;
            int expected = 257;

            CalcTest c = new CalcTest();
            int actual = c.Division(a, b);

            Assert.AreEqual(expected, actual);
        }
    }
}