#Admin Access

1. Add this setting in admin setting for GST 18% {[User / Partner],
   S GST: 9%,
   C CGST: 9%} apply this in a standerd way for both access(User/Partner) in payment part.
2. The admin access bottom navigation bar is missing 1 option in right side check it add add a option.
3. In the user access in invitation Builder in the last stage where we show NFC Card Add a Order Button Below it. And Create a Section in admin access to
   show the order list.
4. If any user Uses a coupon code Then show this activity in logs section of admin panel [User Name (Contact Phone)|Coupon Code| Person Who own coupons(Partner Name OR Agency Name OR Admin Coupon) | DateTime]

---

#partner access

1. be default partner should have 0 credits if not perchased any plans.

---

#Invitation Builder(Common for Admin|User|Partner)

- Family Audio should be able to upload in the invitation builder (If the user adds the music and the family audio then first the family audio should play after it end then the music should play)
- Check the implementation of the invitation builder.
- In Download invitation option in button navigation bar in mobile view the invitation should be downloaded in pdf format properly with the design.

---

#Testings(Browser In Mobile View)

- Check the user access invitation builder last stage NFC card section order button.
- Check the delete coupon icon is working or not.
- Check the coupon code is working or not along with the logs section.
- Check the user access invitation builder last stage NFC card section order button
- Check the uses & partner acccess If 18% GST is applied or not before the payment after they have selected the plan.
- Check in the invitation link, if the invitation is working or not and the download invitation button is working or not in the invitation link mobile view in button navigation bar.
- Use a partner coupon code in user access and check if that entry is comming in the admin logs section or not .
- If any user Uses a coupon code Then show this activity in logs section of admin panel [User Name (Contact Phone)|Coupon Code| Person Who own coupons(Partner Name OR Agency Name OR Admin Coupon) | DateTime]

- Check the user access invitation builder last stage NFC card section order button
- Check the uses & partner acccess If 18% GST is applied or not before the payment after they have selected the plan.
- Check in the invitation link if the invitation is working or not and the download invitation button is working or not.
- The partner will get 50 credits if they purchase a plan. in the partner dashboard there is a popup for buy credits and upgrade plan pls featch the partner plan that we have created in the admin access.

Create a proper implementation plan for this with proper detailed testings
{

- If any user uses a coupon code of any partner then user Dont Have to pay any amount for the plan and then substract 5 credit from the partner credits account if his coupon is used by any user.(Directly Skip the payment process for user is the total amount is 0 or using a partner coupon code)
- payment gateway as now its on test mode If need for use this card no"5500 6700 0000 1002" & Use a random CVV and any future date. So you can test the payment flow after payment success & fail as well.
  }

- NFC Orders are not comming in admin pannel.
- Remove the Download as PDF card below the NFC Order card from 6th step in invitation builder.
- When partner create a invitation in his access then just substract 5 credits from the partner credits account.

1. Partner Login Should Not be able to login into user access from any function flow Analys all funtion flow properly.
2. Google authentication login not working
3. After entering Coupon Code Direct Show them 1 invitation free and dont select any plan from user plans?
4. If Partner want to Upgrade Plan then he have to perchase the full Plan again, No Top-UP Should be avilable.
5. "Planed & Managed by " This should be editable in Partner Access->Settings.

---

1. In Admin access, Show all payment analytics in dashboard as you have already done in the section.
2. In Admin access, When Create Partner Plan and also able to add credits in that plan, Add the Partner Plan from admin access according to the attached Image with each detailings.
3. In Partner access, Show all Users Details who have used the partner coupon code in the Usage History Section.
4. In User access the side bar is not visible in mobile view from the buttom nav bar.
5. If Partner want to Upgrade Plan then he have to perchase the full Plan again, No Top-UP Should be avilable.
6. In Partner access, Give opions in Settings to add Social Media links(Facebook, Instagram, Whatsapp ,Website).
7. In User access, When the user use a partner coupon code then show the partner branding in the footer with the Partner Name/Agency Name and Social Media Icons with link (Facebook, Instagram, Whatsapp ,Website), According to Partner Plan in the published invitation page footer as ihave also attached a referenct in the footer.
8. For now Hide the NFC Card Order Section From the invitation builder.
9. Create privacy Policies & terms and conditions according to our Business & software and add it in the footer of the website.
10. Remove this Button "Get Next invitation button on 50% off" From User Access.
11. Check all the implementation in the browser with all the small detailings.

Here are my answers for your questions & update the plan again
{

1. Remove all
2. Add to all themes
3. Store as separate
   }

Also add this feature to admin panel {In Admin Access, Admin should be able to Upload new invitation templates in .zip files(give a popup window) which will include all the html, css, js and images files provide a sample to use to understand how it works & add documentation for it do all this in templates section.} Add this in everything in detailed to plan and show me.

And after user uses a coupon the in his invitation the partner footer branding is comming with social logos or not.


Create a proper implementation plan for this with proper detailed testings in browser 
{
Check all this project according to the all roles in this @file:secu and fix the problems. 
Unable to create a Coupon In Admin Access.
Unable to Delete a Coupon In Partner Access.
Check all Coupon Functionality for admin & partner access. 
Do a Compleate Coupon code test on user access create coupons on admin & partner access and check the coupon code flow.
All check the partner plan if the credits are added or not after partner buy the plan.
Also Check the Coupon Functionality for user access.
And the coupon flow and logs are working properly or not for partner 'usage history' & admin 'logs'.
In the admin access Add the Credit Option to the plan section too add the credits to the partner plan.
}


Create a proper implementation plan for this with proper detailed testings in browser {
Frontend & Backend.
- Google Login not working
- If you test the coupon flow then use this card no"5500 6700 0000 1002" & Use a random CVV and any future date. So you can test the payment flow after payment success & fail as well. use this 9860509908 phone no if required and skip otp if asked.

Partner access:
      - In Generate Coupon Code popup remove the option of discount type only add a message as "5 Credits will be Deducted from your account if this coupon is used by any Cusotner."(Meaning If User uses this coupon he will get 100% discount and no payment will taken from user also the payment setup will skip automatically on continue buttom) and also add a input field for enter the coupon code name and show abilable credits below.
      - In the top navigation bar there is credit only show total avilable credits of the partner.
      - When Partner by any plan for his credits the show him a full view of billing before procceding to payment to plan and show how much we are charging him for gst with the total payment cost and also give option to add partners agency GST no. to add this gst number in out invoice.
      - Show the user/client name & datetime in usage history when anyone uses the partner coupon.
      - In the usage history section add a filter to filter by date range.
      - 
User Access:
      - In RSVP's section add guest button is not working also check the export button should download the guest list in CSV file.
}

Create a proper implementation plan for this with proper detailed testings in browser 
{

}

Admin Access:
- Sync "Total Revenue" from transactions section in the dashboard in Admin Access.
- Create a option for Enable/Disablein Setting For Enabling free access to use this User for 7 days for 1st time only (Only 1 Invitation) [After Enable a "Create Now For Free Access" button will be added in the Frontpage hero section "Create Now Just ₹399" this button will be replace also add me more section also remember if the admin disable this then all buttens will also get disabled and hidden].
- Add a option in admin access top navigation bar to directly access the Webiste Frontend.
- Add option in setting to manage the credit deduction for partner coupon code. (Meaning if user uses partner coupon code then how much credit will be deducted from partner account) & to create invitation in partner access.
- Make the admin setting page more user friendly, responcive and easy to navigate.

User Access:
- In "Billing History", 'Current Plan' & 'Payment Method' this UI is not linked with any functional backend check it and make it real working.
- In RSVP's section add guest button is not working also check the export button should download the guest list in CSV file.

Partner Access:
- When we delete a coupon code in partner access then after deletion he should Redirect to coupon section.

Frontend:
- Add live mobile preview to hero section mobile mockup as we did in the user access - templates section.

Templates:(Admin/Partner/User)
- When user preview any templates load a sample images as i give you before. (Meaning if user click on preview button then load a sample images.) [Do this for all templates]


Add a free plan for user if the free acess option if enabled in admin setting. (Meaning if the free access option is enabled then the user should be able to create 1 invitation for free for 7 days(No payment required) and after 7 days he should be redirected to the payment page to buy a plan.)