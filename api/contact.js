// File: api/contact.js

const nodemailer = require('nodemailer');

export default async function (req, res) {
  if (req.method === 'POST') {
    const { name, email, subject, message } = req.body;

    // Create a transporter object using SMTP transport
    const transporter = nodemailer.createTransport({
      host: 'smtp.gmail.com', // Replace with your SMTP host
      port: 587,
      secure: false, // true for 465, false for other ports
      auth: {
        user: 'mirissasnorkelingadventures@gmail.com', // SMTP username
        pass: 'Kasun1986' // SMTP password
      }
    });

    // Setup email data
    const mailOptions = {
      from: email, // sender address
      to: 'mirissasnorkelingadventures@gmail.com', // list of receivers
      subject: subject, // Subject line
      text: `From: ${name}\nEmail: ${email}\n\nMessage:\n${message}` // Plain text body
    };

    try {
      // Send email
      await transporter.sendMail(mailOptions);
      res.status(200).json({ message: 'Your message has been sent successfully.' });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'An error occurred while sending the email.' });
    }
  } else {
    // If method is not POST, return 405 error
    res.setHeader('Allow', ['POST']);
    res.status(405).end(`Method ${req.method} Not Allowed`);
  }
}
