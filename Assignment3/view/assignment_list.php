<?php
include('view/header.php');

?>

<!-- Section to Display Assignments -->
<section class="assignment-container">
    <h2>Assignments</h2>
    <form action="." method="get">
        <select name="course_id">
            <option value="0">View All</option>
            <?php foreach ($courses as $course) : ?>
                <option value="<?= $course['courseID'] ?>" <?= $course_id == $course['courseID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($course['courseName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Go</button>
    </form>

    <?php if (!empty($assignments)) : ?>
        <?php foreach ($assignments as $assignment) : ?>
            <div class="assignment-item">
                <p><strong><?= htmlspecialchars($assignment['courseName']) ?></strong></p>
                <p><?= htmlspecialchars($assignment['Description']) ?></p>

                <!-- Delete Form -->
                <form action="." method="post" style="display:inline;">
                    <input type="hidden" name="action" value="delete_assignment">
                    <input type="hidden" name="assignment_id" value="<?= $assignment['ID'] ?>">
                    <button type="submit" class="remove-button" onclick="return confirm('Are you sure you want to delete this assignment?')">X</button>
                </form>

                <!-- Edit Button -->
                <button onclick="showEditForm(<?= $assignment['ID'] ?>, '<?= htmlspecialchars($assignment['Description'], ENT_QUOTES) ?>')">Edit</button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No assignments exist<?= $course_id ? ' for this course' : '' ?> yet.</p>
    <?php endif; ?>
</section>

<!-- Add Assignment Section -->
<section class="assignment-container">
    <h2>Add Assignment</h2>

    <form action="." method="post">
        <input type="hidden" name="action" value="add_assignment">

        <label for="course_id">Course:</label>
        <select name="course_id" required>
            <option value="">Please select</option>
            <?php foreach ($courses as $course) : ?>
                <option value="<?= $course['courseID'] ?>">
                    <?= htmlspecialchars($course['courseName']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description:</label>
        <input type="text" name="description" id="description" maxlength="120" required>

        <button type="submit">Add</button>
    </form>
</section>

<!-- Edit Assignment Section (Hidden by Default) -->
<section id="edit-assignment-container" class="assignment-container" style="display:none;">
    <h2>Edit Assignment</h2>
    <form action="." method="post">
        <input type="hidden" name="action" value="edit_assignment">
        <input type="hidden" id="edit-assignment-id" name="assignment_id">

        <label for="edit-description">New Description:</label>
        <input type="text" id="edit-description" name="description" maxlength="120" required>

        <button type="submit">Update</button>
        <button type="button" onclick="hideEditForm()">Cancel</button>
    </form>
</section>

<p><a href=".?action=list_courses">View/Edit Courses</a></p>

<script>
function showEditForm(id, description) {
    document.getElementById('edit-assignment-id').value = id;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-assignment-container').style.display = 'block';
}

function hideEditForm() {
    document.getElementById('edit-assignment-container').style.display = 'none';
}
</script>

<?php
include('view/footer.php');
?>
