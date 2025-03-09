@extends('layouts.page')
@section('title','Edit Address')
@section('content')
<div class="careers-container">
    <h2>Join Our Team</h2>
    <p>We’re looking for passionate individuals to join our sports team.</p>

    <div class="application-form hidden">
        <h3>Apply for a Position</h3>
        <form id="jobApplicationForm">
            <input type="hidden" id="jobId" name="jobId">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="resume">Upload Resume</label>
            <input type="file" id="resume" name="resume" required>

            <button type="submit">Submit Application</button>
        </form>
        <button class="close-btn">Close</button>
    </div>
</div>


@endsection