@extends('layouts.app')

@section('title', 'Contact Us - Sarkari Result')

@section('content')
<div style="background: var(--bg-primary); padding: 2rem 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--primary-color); margin-bottom: 2rem; text-align: center;">
            Contact Us
        </h1>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); margin-bottom: 2rem;">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Get In Touch</h2>
                <p style="line-height: 1.6; color: var(--text-primary); margin-bottom: 1.5rem;">
                    We value your feedback and are always here to help. If you have any questions, suggestions, 
                    or need assistance regarding government jobs, results, or any other information, please feel free to contact us.
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div>
                        <h3 style="color: var(--primary-color); margin-bottom: 0.5rem;">📧 Email</h3>
                        <p style="color: var(--text-primary);">contact@sarkariresult.com</p>
                        <p style="color: var(--text-primary);">info@sarkariresult.com</p>
                    </div>
                    
                    <div>
                        <h3 style="color: var(--primary-color); margin-bottom: 0.5rem;">📱 Social Media</h3>
                        <p style="color: var(--text-primary);">WhatsApp Channel</p>
                        <p style="color: var(--text-primary);">Telegram Group</p>
                        <p style="color: var(--text-primary);">Facebook | Twitter | Instagram</p>
                    </div>
                </div>
            </div>
            
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); margin-bottom: 2rem;">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Contact Form</h2>
                <form style="display: grid; gap: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Name *</label>
                        <input type="text" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem; font-size: 0.875rem;">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Email *</label>
                        <input type="email" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem; font-size: 0.875rem;">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Subject *</label>
                        <input type="text" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem; font-size: 0.875rem;">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Message *</label>
                        <textarea rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem; font-size: 0.875rem; resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" style="background: var(--primary-color); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                        Send Message
                    </button>
                </form>
            </div>
            
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color);">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Important Notice</h2>
                <p style="line-height: 1.6; color: var(--text-primary);">
                    Please note that we are not affiliated with any government department. We only provide information 
                    about government jobs and schemes. For official inquiries related to specific jobs or schemes, 
                    please contact the respective government departments directly.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
