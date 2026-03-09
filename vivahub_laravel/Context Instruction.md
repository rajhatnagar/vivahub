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

Partner access: - In Generate Coupon Code popup remove the option of discount type only add a message as "5 Credits will be Deducted from your account if this coupon is used by any Cusotner."(Meaning If User uses this coupon he will get 100% discount and no payment will taken from user also the payment setup will skip automatically on continue buttom) and also add a input field for enter the coupon code name and show abilable credits below. - In the top navigation bar there is credit only show total avilable credits of the partner. - When Partner by any plan for his credits the show him a full view of billing before procceding to payment to plan and show how much we are charging him for gst with the total payment cost and also give option to add partners agency GST no. to add this gst number in out invoice. - Show the user/client name & datetime in usage history when anyone uses the partner coupon. - In the usage history section add a filter to filter by date range. -
User Access: - In RSVP's section add guest button is not working also check the export button should download the guest list in CSV file.
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

<!--
- Verify Updats on live version as i have hosted this project on hosting.
You can access it via ssh/ftp via this creds{FTP/SSH
Server IP: 103.191.208.202,
Username: whlmstql,
Password: P(;OY0dQ3jt10t,
FTP Port: 21,
SSH Port: 22, } check the beta folder, update the code on both sides
- Live the changes via given crediantials and verify all the change on this https://vivahub.in/beta path
-->

{

- Add this @directory:prototype\wedding-templates\assets images in this laravel project and change the path fir default images preview for all invitation templates because when ill live it like this showes error.
- In admin panel, also update the plans update features its showing erros.
- In user access, RSVP section add guest button is not working also check the export button should download the guest list in CSV file.(as shown in the attachment)
- In user access, take gst number at billing of user before billing payment.(as shown in the attachment)
- in partner access, on coupon delete button is not redirecting to coupon section.(as shown in the attachment)
- In admin access, on create plan error is comming.(as shown in the attachment)
- In admin access, in transaction section the export button is not working.
  }
  create a brief plan to fix this errors.

# Check and fix:

- All images(Are not able preview,(may be some problem in image path)) for live site.
- In Partner Access, Setting Contact Person not updating.
- In Partner Access, Mobile View In invitation builder the user access side bar is showing pls hide it there.
- Add GST Details in the Invoice and check with in both Access(User/Partner).
- In Partner & User Billing Section Invoice Preview & Download is showing error.

- In Admin Access, When we change to day mode and switch the new section or page then it auto switch to night mode Fix this(Untill the user dont switch on dont change mode automaticaly).

- Show same "Total Revenue" in Admin Access Dashboard as we showning in the payment analytics(transaction) section.

- In mobile view, there is invitation builder there is a buttom nav bar some of the body content is hidden behind it pls fix it.(problem exists in all templates, in invitation builder, and in many sections check it in all access (Admin/Partner/User))

* Check the workflow of invitation builder in admin/partner/user access,

          - there is  "Download invitation" option in invitation linke in buttom nav icons, there for it we have to add a option in last step to upload a img or pdf to upload it there. (Meaning if user will download the invitation from the link then he will get this img or pdf of invitation).

          - Check the content is change realtime in the preview properly or not fix it and enhance it, also check the edit plan option everything is working properly or not.

          - Where user have to select a user plan(ask for coupon code here only if valid coupon code is given then dont ask for no-payment directly create invitation link and that will will have validity according to partner coupon code validity after validity it will be expired the link will be expired)if no coupon code is given then ask to Pay for selected plan to create invitation link.

          - When Partner Create invitation the he can also select a user plan(Same User Flow without coupon code option) OR Use his 5 credit to create invitation link(Show the user on publish button "5 Credits Used to create link").

          - When Admin will Create a Invitation dont as for payment directly create invitation links but show all the options like user plan, partner plan, coupon code, etc. (But dont ask for payment).

Create a plan for this:

- Check all the users plans limits and conditions and apply that to all for. (Partner/User)
- Check the invitation builder for in mobile view the bottom nav bar is hiding the content or not, if yes then pls fix it.
- In admin access day/night mode toggle button is not working pls fix it, as we change the page the mode is not retained the same selected mode check and fix it.

User Access:

- Updated Invitation Link Copy Button in dashboard also.
- User Profile Photo Not Updating after uploading if any error is there pls fix it also show error to user on uploading if user adds a wrong file type.
- invitation link not containing the user info that he filled in invitation builder.
- Move the download invitation option ( Forinvitation link in buttom nav icons) in the 5th step.
- Check the Invitation Builder workflow with all fields and with the coupon & payment is correct or not.
- View More button not working on select plan popup.

Admin Access:

- Add the download invitation option ( For invitation link in buttom nav icons) in the 5th step (Just as we have done in user access).
- Log Section, System log & Coupon logs are not working properly.
- "It's Official" page the go to dashborad button is directly redirecting to the User Access Dashboard while I'm in Admin Access.
- invitation builder is is hidding buttom page content in mobile view pls fix it.

Partner Access:

- Partner Profile Photo Not Updating after uploading if any error is there pls fix it also show error to partner on uploading if partner adds a wrong file type.
- On opening invitation builder template preview not showing.
- That partner invitation workflow is compleately wrong pls fix it. Check the Invitation Builder workflow with all fields and with the Credits, Invoice, Payment and every thing is correct or not.
- Buy Credit button not working in mobile view.
- invitation builder is is hidding buttom page content in mobile view pls fix it.

#Test Case

- Partner Coupons, Buy Credit, Create Inivtation workflow.
- User Coupons(Admin/Partners) also check the partner usage logs & logs are creating or not check workflow properly in a brief.
- Check Invitation Builder workflow for all access(Partner & User) and invitation link check everything is working properly according to our workflow or not.

Create a plan to fix all this:

In the Sidebar just keep the name "Store", Pls fix the invitation builder section for responcivness in desktop view.

1. Unhide the NFC card from the "its official" page before and in the same way show the preview of NFC card from both sides in the store. also the dropdown values are not visible.
2. Couple Custom Logo, Show the users option to select templates, as i have already provided you the pdf templates i have provided you.
3. Welcome Boards, Show the users option to select templates, as i have already provided you the pdf templates i have provided you.

# New Features and Requirments:

- Couples Logo (This will be like a realtime svg editor, Show the users our SVG templates as it is (I have added it here [Welcome Board and Logo\Couple Logo SVG]) edit the text of svg and Show the user Realtime preview of the editing text with the same svg font)
- NFC Card(By default Add Hero Section image in NFC Card Front as we select the invitation)
- Welcome board (Same as the couple logo I have added the templates here [Welcome Board and Logo\Welcome Board SVG]).


Verify All the features in browser of Invitation builder Layout(User/Partner Access) also check the workflow with invitation like, NFC card & Couple Logo are working proper or not.

- User Access Next Invitation 50% off (Only for user, This will work only for one time after User Perchase 1 plan).
- Main Site, Custom Plans Calculator(User should be able to select number of Invitations).
- Android App & IOS App.
