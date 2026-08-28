document.addEventListener('DOMContentLoaded', () => {
  const shareButton = document.getElementById('shareButton');
  const shareText = document.getElementById('shareText');
  const shareIcon = document.getElementById('shareIcon');

  // Save the original button state to revert it later
  const originalText = shareText.textContent;
  const originalIconHtml = shareIcon.outerHTML;

  // Define what you want to share
  const shareData = {
    title: 'RentReceipt - Abuja Rent Receipts Management Solution',
    text: 'Stop manually filling paper receipt books. Issue professional rent receipts directly to tenant WhatsApp in 1-click.',
    url: window.location.origin // Dynamic fallback to your main website domain
  };

  shareButton.addEventListener('click', async () => {
    // 1. Try Native Mobile Sharing first (iOS/Android/Safari)
    if (navigator.share && navigator.canShare && navigator.canShare(shareData)) {
      try {
        await navigator.share(shareData);
        return; // Exit if successful
      } catch (err) {
        // If user cancels the share sheet, do nothing. For other errors, fall through to clipboard.
        if (err.name !== 'AbortError') console.error('Share error:', err);
      }
    }

    // 2. Desktop Fallback: Copy link to clipboard
    try {
      await navigator.clipboard.writeText(shareData.url);
      
      // Visual Success Feedback State
      shareText.textContent = 'Link Copied! ✅';
      shareText.classList.add('text-emerald-400');
      shareButton.classList.add('border-emerald-500/30', 'bg-emerald-950/20');
      
      // Revert button back to normal after 2.5 seconds
      setTimeout(() => {
        shareText.textContent = originalText;
        shareText.classList.remove('text-emerald-400');
        shareButton.classList.remove('border-emerald-500/30', 'bg-emerald-950/20');
      }, 2500);

    } catch (clipboardErr) {
      console.error('Clipboard copy failed, routing to WhatsApp fallback:', clipboardErr);
      
      // 3. Last Resort Fallback: Direct WhatsApp referral URL
      const whatsappText = encodeURIComponent(`${shareData.text} Check it out here: ${shareData.url}`);
      window.open(`https://wa.me{whatsappText}`, '_blank');
    }
  });
});
