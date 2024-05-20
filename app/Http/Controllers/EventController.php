<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'regional_category' => 'required',
                'branch_name' => 'required'
            ]);

            $event = Event::create($request->all());

            // Upload and store multiple images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('event_images');
                    $event->images()->create(['image_path' => $path]);
                }
            }

            return response()->json($event, Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, Event $event)
    {
        try {
            $request->validate([
                'title' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'regional_category' => 'required',
                'branch_name' => 'required'
            ]);

            $event->update($request->all());

            return response()->json($event, Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showBranchEvents($branchName)
    {
        try {
            $events = Event::where('branch_name', $branchName)->with('images')->get();
            return response()->json([
                'result' => true,
                'message' => 'Successfully fetched branch events data',
                'data' => $events,
                'status' => 'OK'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
