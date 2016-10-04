<form class="form" id="inviteFriends" action="/user/invite-friends" method="POST">
  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title" id="myModalLabel">Invite Friends to SocialPrayer</h3>
    <h6 class="modal-title" id="myModalLabel">(Please enter email addresses seperated by commas, semi-colons or one per line)</h6>
  </div>
  <div class="modal-body">
  	<textarea class="form-control" name="invitees" id="invitees" rows="6" placeholder="Friends" required="required" style="border-color: #5CACEE;"></textarea>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Send Invites</button>
  </div>
  {{ csrf_field() }}
</form>