using System;
using System.Windows.Forms;
using System.Collections.Generic;
using System.Collections.Specialized;

namespace CSharpClient
{
    public partial class frmClientView : Form
    {
        /// <summary>
        /// Initialize the form and fill the form with the clients details
        /// </summary>
        /// <param name="p_objClient">Client Object retrieved through REST</param>
        public frmClientView(Client p_objClient)
        {
            InitializeComponent();
            this.txtID.Text = p_objClient.Id.ToString();
            this.txtFirstname.Text = p_objClient.Firstname;
            this.txtLastname.Text = p_objClient.Lastname;
        }

        /// <summary>
        /// Close the windows when click on leave button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void cmdClose_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}
