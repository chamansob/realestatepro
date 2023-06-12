<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class AgentController extends Controller
{
    //Agent Dashboard

    public function AgentDashboard()
    {
       return view('agent.agent_dashboard');
    }
   public function AgentLogin()
    {
       return view('agent.agent_login');
    }
}
