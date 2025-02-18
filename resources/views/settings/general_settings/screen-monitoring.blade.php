@extends('layout.main')

@section('content')
    <span id="form_result"></span>

    <section class="forms">
        <div class="container-fluid d-flex justify-content-center align-items-center vh-100 flex-column">
            
            <!-- Employee Dropdown -->
            <div class="user-select">
                <label for="user">Select Employee:</label>
                <select id="user" class="form-control">
                    <option value="">-- Select a Employee --</option>
                    @foreach($Employee as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Monitor Screen (Initially Hidden) -->
            <div class="monitor-frame d-none" id="monitorScreen">
                <!-- Blinking Red Recording Dot -->
                <div class="recording-dot"></div>

                <!-- Monitor Screen -->
                <div class="monitor-screen">
                    <div class="message">🚫 You are not authorized for this 🚫</div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Dropdown Styling */
        .user-select {
            margin-bottom: 20px;
            text-align: center;
        }
        .user-select label {
            font-weight: bold;
            margin-right: 10px;
        }
        .form-control {
            width: 250px;
            display: inline-block;
        }

        /* Smaller Monitor Frame */
        .monitor-frame {
            position: relative;
            width: 75%;
            max-width: 700px; /* Adjusted Size */
            height: 65vh; /* Adjusted Height */
            background: #222;
            border: 10px solid #444;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Smaller Monitor Screen */
        .monitor-screen {
            width: 92%;
            height: 80%;
            background: black;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border: 4px solid #111;
            border-radius: 8px;
            box-shadow: inset 0px 0px 12px rgba(255, 0, 0, 0.2);
        }

        /* Unauthorized Message */
        .message {
            font-size: 22px;
            font-weight: bold;
            color: red;
            background: rgba(0, 0, 0, 0.8);
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }

        /* Blinking Red Recording Dot */
        .recording-dot {
            position: absolute;
            top: 8px;
            left: 12px;
            width: 12px;
            height: 12px;
            background-color: red;
            border-radius: 50%;
            box-shadow: 0px 0px 8px red;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.3; }
            100% { opacity: 1; }
        }
    </style>

    <script>
        document.getElementById('user').addEventListener('change', function () {
            let monitorScreen = document.getElementById('monitorScreen');
            if (this.value) {
                monitorScreen.classList.remove('d-none');
            } else {
                monitorScreen.classList.add('d-none');
            }
        });
    </script>
@endsection
