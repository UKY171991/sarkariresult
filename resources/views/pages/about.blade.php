@extends('layouts.app')

@section('title', 'About Us - Sarkari Result')

@section('content')
<div style="background: var(--bg-primary); padding: 2rem 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--primary-color); margin-bottom: 2rem; text-align: center;">
            About Sarkari Result
        </h1>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); margin-bottom: 2rem;">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Our Mission</h2>
                <p style="line-height: 1.6; color: var(--text-primary);">
                    Sarkari Result is your trusted partner in government job search. Since 2014, we have been providing accurate, 
                    timely, and comprehensive information about government job opportunities, exam results, admit cards, and much more. 
                    Our mission is to bridge the gap between job seekers and government employment opportunities.
                </p>
            </div>
            
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color); margin-bottom: 2rem;">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">What We Provide</h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Latest Government Job Notifications
                    </li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Exam Results and Merit Lists
                    </li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Admit Cards and Hall Tickets
                    </li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Answer Keys and Cut-off Marks
                    </li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Admission Notifications
                    </li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        ✓ Syllabus and Exam Patterns
                    </li>
                    <li style="padding: 0.5rem 0;">
                        ✓ Sarkari Yojana Information
                    </li>
                </ul>
            </div>
            
            <div style="background: var(--bg-secondary); padding: 2rem; border-radius: 0.5rem; border: 1px solid var(--border-color);">
                <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Important Notice</h2>
                <p style="line-height: 1.6; color: var(--accent-color); font-weight: 500;">
                    Sarkari Result is not a government website. We are an independent portal that provides information 
                    about government jobs and related notifications. We collect information from official sources and 
                    present it in an organized manner for the convenience of job seekers. We have no affiliation with 
                    any government department or organization.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
