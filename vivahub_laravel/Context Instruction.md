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
- Test payment gateway as now its on test mode use this card no"5500 6700 0000 1002" & Use a random CVV and any future date. So you can test the payment flow after payment success & fail as well.
}

- NFC Orders are not comming in admin pannel.
- Remove the Download as PDF card below the NFC Order card from 6th step in invitation builder.
- When partner create a invitation in his access then just substract 5 credits from the partner credits account.